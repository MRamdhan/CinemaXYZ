<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    function homeOwner() {
        $logs = Log::all();

        return view('owner.homeOwner', compact('logs'));
    }

    public function filter(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $start = \Carbon\Carbon::parse($start)->startOfDay();
        $end = \Carbon\Carbon::parse($end)->endOfDay();

        if ($end->lt($start)) {
            $temp = $start;
            $start = $end;
            $end = $temp;
        }
        
        $logs = Log::whereBetween('created_at' ,[$start, $end])->get();
        
        return view('owner.homeOwner', compact('logs'))->with('message', 'berhasil Memfilter');;
    }

    function logOwner() {
        $logs = Log::all();

        return view('owner.log', compact('logs'));
    }
}
