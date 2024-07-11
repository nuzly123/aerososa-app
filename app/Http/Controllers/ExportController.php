<?php

namespace App\Http\Controllers;

use App\Exports\AirTrafficExport;
use App\Models\AirTraffic;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //
    public function export(Request $request)
    {

        $filters = [
            'flight_date' => $request['flight_date'],
            'aircraft_id' => $request['aircraft_id'],
            'flight_route' => $request['flight_route'],
            'captain_id' => $request['captain_id'],
            'first_official_id' => $request['first_official_id'],
            /* 'flight_assistant_id' => $request['flight_assistant_id'], */

        ];

        $query = AirTraffic::query()
            ->with('flight', 'aircraft', 'captain', 'first_official')
            ->when($filters['flight_date'], function ($query) use ($filters) {
                return $query->whereDate('flight_date', $filters['flight_date']);
            })
            ->when($filters['aircraft_id'], function ($query) use ($filters) {
                return $query->where('aircraft_id', $filters['aircraft_id']);
            })
            ->when($filters['flight_route'], function ($query) use ($filters) {
                return $query->where('flight_route', $filters['flight_route']);
            })
            ->when($filters['captain_id'], function ($query) use ($filters) {
                return $query->where('captain_id', $filters['captain_id']);
            })
            ->when($filters['first_official_id'], function ($query) use ($filters) {
                return $query->where('first_official_id', $filters['first_official_id']);
            });
        
        if ($query->count() === 0) {
            return response()->json(['error' => 'No records found for the selected filters.'], 404);
        }
        return Excel::download(new AirTrafficExport($filters), 'air_traffic.xlsx');
    }
}
