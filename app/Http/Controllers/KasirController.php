<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Log;
use App\Models\Movie;
use App\Models\Purchase;
use App\Models\PurchaseTicket;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Ticket;

class KasirController extends Controller
{
    function detailmovie(Request $request,Movie $movie) {
        if (Auth::user()->role !== 'kasir') {
            return redirect('/')->with('message', 'Hanya kasir yang dapat mengakses halaman ini!');
        }
        
        // Ambil data jam tayang dari kolom `tayang`
        $showtimes = [];
        if (!empty($movie->tayang)) {
            $showtimes = explode(',', $movie->tayang);
        }

        return view('kasir.detail', [
            'movie' => $movie,
            'movie_name' => $movie->name,
            'movie_id' => $movie->id,
            'movie_image' => $movie->image,
            'showtimes' => $showtimes,
        ]);
    }

    function index(Request $request)
    {
        $movie_id = $request->movie_id;
        $movie_name = $request->movie_name;
        $time = $request->time;

        // Hapus tiket yang kadaluarsa (lebih dari sehari yang lalu)
        PurchaseTicket::where('created_at', '<', Carbon::now()->startOfDay())->delete();

        if (!empty($movie_id) && !empty($time)) {
            // Ambil pembelian untuk film dan waktu tertentu hanya untuk hari ini
            $purchase = Purchase::where([
                ['movie_id', $movie_id],
                ['time', $time]
            ])
            ->whereDate('created_at', Carbon::today()) // Filter berdasarkan hari ini
            ->with(['ticket'])
            ->get();

            $movie = Movie::where('id', $movie_id)->get();

            // Jika ada pembelian tiket
            if ($purchase->isNotEmpty()) {
                $seats_sold = [];

                foreach ($purchase as $value) {
                    // Ambil tiket berdasarkan pembelian
                    $tickets = PurchaseTicket::where('purchase_id', $value->id)->get();
                    foreach ($tickets as $ticket) {
                        $seats_sold[] = $ticket->seat; // Simpan kursi yang terjual
                    }
                }

                return view('kasir.seat_selection', [
                    'date' => date('d F'),
                    'movie' => $movie,
                    'movie_name' => $movie_name,
                    'time_choose' => $time,
                    'purchase' => $purchase,
                    'seats_sold' => $seats_sold,
                    'sold_total' => count($seats_sold),
                ]);
            } else {
                // Jika tidak ada pembelian tiket untuk hari ini
                return view('kasir.seat_selection', [
                    'date' => date('d F'),
                    'movie_name' => $movie_name,
                    'movie' => $movie,
                    'time_choose' => $time,
                    'purchase' => $purchase,
                    'seats_sold' => [],
                    'sold_total' => 0,
                ]);
            }
        } else {
            return redirect()->back()->with('message', 'Parameter wajib diisi');
        }
    }

    function confirmOrder(Request $request) {
        $movie = Movie::where('id', $request->movie)->first();
        $time = $request->time_choose;
        $seats = $request->seats;
        
        $day = date('l');
        if ($day == 'Saturday' || $day == 'Sunday') {
            $ticketPrice = 60000;
        } else {
            $ticketPrice = 50000;
        }
        $fee = 2000;

        $result = explode(',', $seats);
        // dd($result);
        $totalTicketPrice = $ticketPrice * count($result);
        $totalfee = $fee;
        $total = $totalTicketPrice + $totalfee;
        if ($seats != null) {
            return view('kasir.confirm_order', [
                'ticketPrice' => $ticketPrice,
                'movie' => $movie,
                'time' => $time,
                'seats' => $seats,
                'count' => count($result),
                'total' => $total,
            ]);
        } else {
            return redirect()->back()->with('error', 'mohon isi kursi/data');
        }
    }
    function createOrder(Request $request, User $user) {
        $movie_name = $request->movie_name;
        $movie_id = $request->movie_id;
        $time = $request->time;
        $total = $request->total;
        $seats = $request->seats;
        $cash = $request->cash;
        $usercreate = $user['id'];

        if (!empty($movie_id) && !empty($time) && !empty($total) && !empty($cash)) {
            if ($cash < $total) {
                return back()->withErrors(['message' => 'Uang Anda Kurang']);
            } elseif ($cash >= $total) {
                $purchase = Purchase::create([
                    'movie_id' => $movie_id,
                    'date' => date('Y-m-d'),
                    'time' => $time,
                    'total' => $total,
                    'cash' => $cash,
                    'created_by' => $usercreate,
                ]);

                $orders = explode(',', $request->seats);
                foreach ($orders as $order) {
                    $code = Str::random(6);
                    PurchaseTicket::create([
                        'purchase_id' => $purchase->id,
                        'seat' => $order,
                        'code' => 'INV' . $code,
                    ]);
                }
                $change = $cash - $total;

                $this->saveHistory($movie_id, date('Y-m-d'), $time, $total, $seats, $usercreate, $change, $cash);
                return view('kasir.transac', [
                    'movie_name' => $movie_name,
                    'movie_id' => $movie_id,
                    'date' => date('Y-m-d'),
                    'time' => $time,
                    'total' => $total,
                    'cash' => $cash,
                    'seats' => $seats,
                    'kembalian' => $change,
                    'id' => $purchase->id,
                ])->with('message', 'pesanan berhasil dibuat!');
            }
        } else {
            return redirect()->back()->with([
                'message' => 'parameter wajib diisi'
            ]);
        }
    }
    public function saveHistory($movieId, $date, $time, $total, $seats, $userId, $change, $cash)
    {
        $history = History::create([
            'movie_id' => $movieId,
            'date' => $date,
            'time' => $time,
            'total' => $total,
            'seats' => $seats,
            'change' => $change,
            'cash' => $cash,
            'created_by' => $userId,
        ]);
        return $history;
    }

    function history() {
        $histories = History::with('movie')->get();

        $groupedHistories = $histories->groupBy(function ($history) {
            return \Carbon\Carbon::parse($history->created_at)->format('d-m-Y');
        })->map(function ($dailyHistories) {
            return [
                'date' => $dailyHistories->first()->created_at,
                'total' => $dailyHistories->sum('total'),
            ];
        });

        $date = $groupedHistories->pluck('date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d-m-Y');
        })->toArray();

        $profit = $groupedHistories->pluck('total')->toArray();

        $totalProfit = array_sum($profit);

        // dd($histories);
        $chart = (new LarapexChart)
        ->setType('bar')
        ->setTitle('Riwayat')
        ->setColors([
            '#003b6d'
        ])
        ->setSubtitle('Riwayat Transaksi')
        ->setXAxis($date)
        ->setDataset([
            [
                'name' => 'Income',
                'data' => $profit
            ]
        ]);
        return view('kasir.history', ['histories' => $histories, 'chart' => $chart, 'total' => $totalProfit]);
    }
    function cari(Request $request) {
        $cari = $request->input('cari');

        $movie = Movie::where('name', 'like', '%' . $cari. '%')->get();

        return view('home', ['movie' => $movie]);
    }

    function filteredChartMethod(Request $request) {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $start = \Carbon\Carbon::parse($start)->startOfDay();
        $end = \Carbon\Carbon::parse($end)->endOfDay();

        $histories = History::with('movie')->get();


        $histories = History::whereBetween('created_at', [$start, $end])->get();
        $groupedHistories = $histories->groupBy(function ($history) {
            return \Carbon\Carbon::parse($history->created_at)->format('d-m-Y');
        })->map(function ($dailyHistories) {
            return [
                'date' => $dailyHistories->first()->created_at,
                'total' => $dailyHistories->sum('total'),
            ];
        });
        $date = $groupedHistories->pluck('created_at')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        })->toArray();

        $profit = $groupedHistories->pluck('total')->toArray();

        $totalProfit = array_sum($profit);

        $chart = (new LarapexChart)
            ->setType('bar')
            ->setTitle('History')
            ->setColors([
                '#003b6d'
            ])
            ->setSubtitle('History Transaction')
            ->setXAxis($date)
            ->setDataset([
                [
                    'name' => 'Income',
                    'data' => $profit
                ]
            ]);

        return view('kasir.history', ['histories' => $histories, 'chart' => $chart, 'total' => $totalProfit])->with('message', 'Filter Data Berhasul');
    }

    function ticket(Request $request){
        $seats = explode(',', $request->seats);
        $purchase = Purchase::where(['movie_id' => $request->id_movie, 'time' => $request->time])->with(['ticket', 'movie'])->latest()->first();

        $tickets = [];

        foreach ($seats as $seat) {
            $ticket = PurchaseTicket::where('purchase_id', $purchase->id)->where('seat', $seat)->first();
            if ($ticket) {
                $tickets[] = $ticket;
            }
        }
        if (!empty($tickets)) {
            $pdf = PDF::loadView('kasir.ticket', compact('tickets', 'purchase'));
            $user = Auth::user();

            Log::create([
                'activity' => $user->username . ' Mendownload Ticket ',
                'user_id' => $user->id,
            ]);
            return $pdf->download($purchase->movie->name . '.pdf');
        } else {
            return back()->with('message', 'Ticket tidak tersedia');
        }
    }
    function inv($id_movie, $seats, $time){
        $movie = Movie::findOrFail($id_movie);

        $purchase = Purchase::where(['movie_id' => $id_movie, 'time' => $time])
                            ->with(['ticket', 'movie'])
                            ->latest()
                            ->first();

        if (!$purchase) {
            return back()->with('message', 'Purchase not found');
        }

        $seatsArray = explode(',', $seats);
        $tickets = [];

        foreach ($seatsArray as $seat) {
            $ticket = PurchaseTicket::where('purchase_id', $purchase->id)
                                    ->where('seat', $seat)
                                    ->first();
            if ($ticket) {
                $tickets[] = $ticket;
            }
        }

        if (!empty($tickets)) {
            $pdf = PDF::loadView('kasir.ticket', compact('tickets', 'purchase'));

            $user = Auth::user();

            Log::create([
                'activity' => $user->username . ' Mendownload Ticket ',
                'user_id' => $user->id,
            ]);

            return $pdf->download($movie->name . '.pdf');
        } else {
            return back()->with('message', 'Tiket tidak tersedia');
        }
    }
}
