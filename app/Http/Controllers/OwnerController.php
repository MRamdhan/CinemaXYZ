<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    function homeOwner() {
        $logs = Log::all();

        return view('owner.homeOwner', compact('logs'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);

        $start = \Carbon\Carbon::parse($request->start_date)->startOfDay();
        $end   = \Carbon\Carbon::parse($request->end_date)->endOfDay();

        if ($end->lt($start)) {
            [$start, $end] = [$end, $start];
        }

        $data = History::with('movie')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        if ($data->isEmpty()) {
            return back()->with('message', 'Data tidak ditemukan');
        }

        $pdf = PDF::loadView('kasir.templatePdf', compact('data'));

        return $pdf->download(
            'Transaksi_' . $start->format('d-m-Y') . '_sampai_' . $end->format('d-m-Y') . '.pdf'
        );
    }


    function logOwner() {
        $logs = Log::all();

        return view('owner.log', compact('logs'));
    }
    function exportPdf() {
        $data = History::with('movie')->get();

        $pdf = PDF::loadView('kasir.templatePdf', compact('data'));
        return $pdf->download('Semua_Data_Transaksi.pdf');
    }
}
