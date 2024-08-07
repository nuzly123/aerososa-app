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
        $aircrafts = Aircraft::with('types', 'residual_fuel')->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $flight_status_array = [
            0 => "MATRICULA",
            1 => "ON-TIME",
            2 => "DELAYED",
            3 => "ADELANTADO"
        ];

        $flight_status_classes = [
            0 => 'badge bg-warning',  // MATRICULA
            1 => 'badge bg-success',  // ON-TIME
            2 => 'badge bg-danger',   // DELAYED
            3 => 'badge bg-primary'   // ADELANTADO
        ];

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

        /* ultimos movimientos */
        /* $latest_flights = AirTraffic::latest()->take(5)->with('flight', 'aircraft')->get(); */
        $today = Carbon::today();
        $latest_flights = AirTraffic::whereDate('created_at', $today)
            ->latest()
            ->take(5)
            ->with('flight', 'aircraft')
            ->get();

        return view('dashboard', compact(
            'total_vuelos',
            'total_pasajeros',
            'total_lbs',
            'total_gaseos',
            'flight_status_array',
            'flight_status_classes',
            'latest_flights',
            'aircrafts',

        ));
        //return dd($total_gaseos);
    }
}
