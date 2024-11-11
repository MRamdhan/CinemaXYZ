<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Movie;
use App\Models\Purchase;
use App\Models\PurchaseTicket;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    function detailmovie(Request $request,Movie $movie) {
        $movie_name = $request->movie->name;
        $movie_image = $request->movie->image;
        $movie_id = $request->movie_id;
        return view('detail', [
            'movie_name' => $movie_name,
            'movie_id' => $movie_id,
            'movie_image' => $movie_image,
        ], compact('movie'));
    }
    function index(Request $request) {
        $movie_id = $request->movie_id;
        $movie_name = $request->movie_name;
        $time = $request->time;

        if (Carbon::now()->format('H:i') === '00:00') {
            PurchaseTicket::where('created_at', '<', Carbon::now()->subDay())->delete();
        }

        if (!empty($movie_id) && !empty($time)) {
            $purchase = Purchase::where([
                ['movie_id', $movie_id],
                ['time', $time]
            ])->with(['ticket'])->get();

            $movie = Movie::where('id', $movie_id)->get();

            if ($purchase != null) {
                $tickets = [];
                foreach ($purchase as $value) {
                    $ticket = PurchaseTicket::where('purchase_id', $value->id)->get();
                    $tickets[] = $ticket;
                }

                $seats_sold = [];
                foreach ($tickets as $ticket) {
                    foreach ($ticket as $v) {
                        $seats_sold[] = $v->seat;
                    }
                }

                return view('seat_selection', [
                    'date' => date('d F'),
                    'movie' => $movie,
                    'movie_name' => $movie_name,
                    'time_choose' => $request->time,
                    'purchase' => $purchase,
                    'seats_sold' => $seats_sold,
                    'sold_total' => count($seats_sold),
                ]);
            } else {
                return view('seat_selection', [
                    'date' => date('d F'),
                    'movie_name' => $movie_name,
                    'movie' => $movie,
                    'time_choose' => $request->time,
                    'purchase' => $purchase,
                    'seats_sold' => [],
                    'sold_total' => 0,
                ]);
            }
        } else {
            return redirect()->back()->with('message', 'Parameter wajib di isi');
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
            return view('confirm_order', [
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
                return view('transac', [
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
        ->setType('bar') // Use areaChart() instead of setType('area')
        ->setTitle('Riwayat')
        ->setSubtitle('Riwayat Transaksi')
        ->setXAxis($date)
        ->setDataset([
            [
                'name' => 'Income',
                'data' => $profit
            ]
        ]);
        return view('history', ['histories' => $histories, 'chart' => $chart, 'total' => $totalProfit]);
    }
}
