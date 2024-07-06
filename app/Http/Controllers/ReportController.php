<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Flight;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function cargoFuelReport(){

        $aircrafts = Aircraft::all();
        $flights = Flight::all();

        return view('reports.cargo_fuel', compact('aircrafts', 'flights'));
    }
}
