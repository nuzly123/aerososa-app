<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\AirTraffic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $airTraffic = AirTraffic::all(); // O la consulta que necesites
        $today = Carbon::today();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $total_vuelos = AirTraffic::whereDate('flight_date', $today)
            ->count();

        $total_pasajeros = AirTraffic::whereDate('flight_date', $today)
            ->sum('total_passengers');

        $total_lbs = AirTraffic::whereDate('flight_date', $today)
            ->sum('total_lbs');

        $total_gaseos = AirTraffic::whereDate('flight_date', $today)
            ->with('fueling')
            ->get()
            ->flatMap(function ($airTraffic) {
                return $airTraffic->fueling;
            })
            ->sum('fuel_amount');

        return view('dashboard', compact('total_vuelos', 'total_pasajeros', 'total_lbs', 'total_gaseos'));
        //return dd($total_gaseos);
    }
}
