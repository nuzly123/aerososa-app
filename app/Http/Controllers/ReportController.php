<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\FlightRoute;
use App\Models\Position;
use App\Models\Position_Details;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function dailyReport()
    {

        $aircrafts = Aircraft::all();
        $flights = Flight::all();
        $flight_routes = FlightRoute::all();

        $positions = [
            'capitan' => Position::where('position', "Capitán")->first(),
            'primer_oficial' => Position::where('position', "Primer Oficial")->first(),
            'tripulante_cabina' => Position::where('position', "Tripulante de Cabina")->first(),
        ];

        $crew_members = [];

        foreach ($positions as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->where('status', 1)->get();
            }
        }

        return view('reports.daily', compact('aircrafts', 'flights', 'flight_routes', 'crew_members'));
    }

    public function flightStatus()
    {
    }
}
