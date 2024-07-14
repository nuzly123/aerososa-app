<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\AirTraffic;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\FlightRoute;
use App\Models\Position;
use App\Models\Position_Details;
use Illuminate\Http\Request;

use \PDF;

class ReportController extends Controller
{
    //
    public function dailyReport()
    {

        $aircrafts = Aircraft::where('status', 1)->get();
        $flights = Flight::where('status', 1)->get();
        $flight_routes = FlightRoute::where('status', 1)->get();
        $airports = Airport::where('status', 1)->get();

        $positions = [
            'capitan' => Position::where('position', "Capitán")->first(),
            'primer_oficial' => Position::where('position', "Primer Oficial")->first(),
            'tripulante_cabina' => Position::where('position', "Tripulante de Cabina")->first(),
            'despachador_vuelo' => Position::where('position', "Despachador de Vuelo")->first(),
        ];

        $crew_members = [];

        foreach ($positions as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->where('status', 1)->get();
            }
        }
        
        $pilots = $crew_members['capitan']->merge($crew_members['primer_oficial']);

        return view('reports.daily', compact('aircrafts', 'flights', 'flight_routes', 'crew_members', 'airports', 'pilots'));
    }
}
