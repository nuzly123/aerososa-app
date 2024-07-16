<?php

namespace App\Http\Controllers;

use App\Exports\AirTrafficExport;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\AirTraffic;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\FlightRoute;
use App\Models\FlightRouteDetail;
use App\Models\FlightTime;
use App\Models\Fueling;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use \PDF;


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
            'first_official_id' => $request['first_official_id']
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

    public function generatePDF(Request $request)
    {
        $flight_reference = $request->input('flight_reference');
        $air_traffic = AirTraffic::with(['createdBy', 'updatedBy', 'flight', 'captain', 'first_official', 'flightAssistants', 'fueling'])
            ->where('reference', $flight_reference)->first();

        if (!$air_traffic) {
            return response()->json(['error' => 'No se encontró el registro de vuelo.'], 404);
        }

        $fueling = $air_traffic->fueling->where('air_traffic_id', $air_traffic->id)->first();

        $flight_status_array = [
            0 => "MATRICULA",
            1 => "ON-TIME",
            2 => "DELAYED",
            3 => "ADELANTADO"
        ];

        $pdf = PDF::loadView('reports.flight_report', compact('air_traffic', 'flight_status_array', 'fueling'));
        return $pdf->download('flight_report.pdf');
    }

    public function aircraftHistoryPDF(Request $request)
    {
        $query = AirTraffic::query()->with('flight', 'aircraft');
        $aircraft_id = $request['aircraft_id'];
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];
        $aircrafts = Aircraft::all();

        $counter = 1;

        $aircraft = null;

        if (!empty($aircraft_id)) {
            $query->where('aircraft_id', $aircraft_id);
            $aircraft = Aircraft::where('id', $aircraft_id)->first();
        }

        if (!empty($fecha_inicial)) {
            $query->whereDate('created_at', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('created_at', '<=', $fecha_final);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json(['error' => 'No se encontraron registros.'], 404);
        }

        // Obtener las fechas inicial y final reales de los registros encontrados
        $real_fecha_inicial = $results->min('created_at');
        $real_fecha_final = $results->max('created_at');

        // Calcular la cantidad de piernas por aeronave
        $legsPerAircraft = $results->groupBy('aircraft_id')->map(function ($group) {
            return $group->count();
        });

        $history = $results->map(function ($result) {
            $aircraft_id = $result->aircraft_id;
            $aircraft_type_id = Aircraft::where('id', $aircraft_id)->value('aircraft_type_id');
            $route_id = FlightRoute::where('route', $result->flight_route)->value('id');
            $flight_time = FlightRouteDetail::where('aircraft_type_id', $aircraft_type_id)
                ->where('route_id', $route_id)
                ->value('time');
            return [
                'result' => $result,
                'flight_time' => $flight_time
            ];
        });

        $pdf = PDF::loadView('reports.aircraft_history', compact('history', 'aircrafts', 'aircraft', 'counter', 'legsPerAircraft', 'real_fecha_inicial', 'real_fecha_final'));
        $pdfContent = $pdf->stream('aircraft_history.pdf')->getOriginalContent();

        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
        //return dd($aircraft);
    }


    /* public function fuelingsPDF(Request $request)
    {
        $query = Fueling::query()->with('aircraft', 'airport', 'approvedBy', 'airTraffic');
        $aircraft_id = $request['aircraft_id'];
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];
        $despachador = $request['despachador_id'];
        $airport_id = $request['airport_id'];

        $aircraft = null;
        $counter = 1;

        if (!empty($aircraft_id)) {
            $query->where('aircraft_id', $aircraft_id);
            $aircraft = Aircraft::where('id', $aircraft_id)->first();
        }

        if (!empty($fecha_inicial)) {
            $query->whereDate('created_at', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('created_at', '<=', $fecha_final);
        }

        if (!empty($despachador)) {
            $query->where('approved_by', $despachador);
        }

        if (!empty($airport_id)) {
            $query->where('airport_id', $airport_id);
        }

        if ($query->count() === 0) {
            return response()->json(['error' => 'No records found for the selected filters.'], 404);
        }

        $fuelings = $query->get();

        $pdf = PDF::loadView('reports.fuelings_report', compact('fuelings', 'aircraft', 'counter'));
        return $pdf->stream('fuelings_history.pdf');
    } */

    public function fuelingsPDF(Request $request)
    {
        $query = Fueling::query()->with('aircraft', 'airport', 'approvedBy', 'airTraffic');
        $aircraft_id = $request['aircraft_id'];
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];
        $despachador = $request['despachador_id'];
        $airport_id = $request['airport_id'];

        $aircraft = null;
        $counter = 1;

        if (!empty($aircraft_id)) {
            $query->where('aircraft_id', $aircraft_id);
            $aircraft = Aircraft::where('id', $aircraft_id)->first();
        }

        if (!empty($fecha_inicial)) {
            $query->whereDate('created_at', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('created_at', '<=', $fecha_final);
        }

        if (!empty($despachador)) {
            $query->where('approved_by', $despachador);
        }

        if (!empty($airport_id)) {
            $query->where('airport_id', $airport_id);
        }

        $fuelings = $query->get();

        if ($fuelings->isEmpty()) {
            return response()->json(['error' => 'No se encontraron registros.'], 404);
        }

        $pdf = PDF::loadView('reports.fuelings_report', compact('fuelings', 'aircraft', 'counter'));
        $pdfContent = $pdf->stream('fuelings_history.pdf')->getOriginalContent();

        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }

    public function crewHistoryPDF(Request $request)
    {
        $query = AirTraffic::query()->with('aircraft', 'flight', 'captain', 'first_official');
        $pilot_id = $request['pilot_id'];
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];

        $counter = 1;
        $pilot = !empty($pilot_id) ? Employee::where('id', $pilot_id)->with('positions')->first() : null;

        if (!empty($pilot_id)) {
            $query->where(function ($q) use ($pilot_id) {
                $q->where('captain_id', $pilot_id)
                    ->orWhere('first_official_id', $pilot_id);
            });
        }

        if (!empty($fecha_inicial)) {
            $query->whereDate('flight_date', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('flight_date', '<=', $fecha_final);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json(['error' => 'No records found for the selected filters.'], 404);
        }

        // Obtener las fechas inicial y final reales de los registros encontrados
        $real_fecha_inicial = $results->min('created_at');
        $real_fecha_final = $results->max('created_at');

        // Calcular la cantidad de piernas por piloto
        $legsPerPilot = $results->groupBy(function ($item) {
            return $item->captain_id ?: $item->first_official_id;
        })->map(function ($group) {
            return $group->count();
        });

        $pdf = PDF::loadView('reports.pilot_history', compact('results', 'pilot', 'counter', 'legsPerPilot', 'real_fecha_inicial', 'real_fecha_final'));

        return $pdf->stream('pilot_history.pdf');
    }


    public function crewFlightTimePDF(Request $request)
    {
        $query = FlightTime::query()->with('airTraffic', 'pilot');
        $pilot_id = $request['pilot_id'];
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];

        $counter = 1;
        $pilot = !empty($pilot_id) ? Employee::where('id', $pilot_id)->with('positions')->first() : null;

        if (!empty($pilot_id)) {
            $query->where('employee_id', $pilot_id);
        }

        if (!empty($fecha_inicial)) {
            $query->whereDate('created_at', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('created_at', '<=', $fecha_final);
        }

        if ($query->count() === 0) {
            return response()->json(['error' => 'No records found for the selected filters.'], 404);
        }

        $results = $query->get();

        // Obtener las fechas inicial y final reales de los registros encontrados
        $real_fecha_inicial = $results->min('created_at');
        $real_fecha_final = $results->max('created_at');

        // Sumar los valores de la columna 'pilot_flight_time' en segundos
        $total_flight_time_in_seconds = $results->sum(function ($result) {
            return Carbon::parse($result->pilot_flight_time)->secondsSinceMidnight();
        });

        // Calcular el total en minutos
        $total_minutes = intdiv($total_flight_time_in_seconds, 60);

        // Crear una instancia de CarbonInterval usando los segundos totales para obtener las horas formateadas
        $total_flight_time_interval = CarbonInterval::seconds($total_flight_time_in_seconds);

        // Formatear el tiempo total en horas
        $total_flight_time = $total_flight_time_interval->cascade()->forHumans([
            'short' => true, // Usar formato corto (h, m, s)
            'options' => Carbon::NO_ZERO_DIFF // Omitir partes con valor cero
        ]);

        $pdf = PDF::loadView('reports.crew_flight_time', compact(
            'results',
            'pilot',
            'counter',
            'total_minutes',
            'total_flight_time',
            'fecha_inicial',
            'fecha_final',
            'real_fecha_inicial',
            'real_fecha_final'
        ));

        return $pdf->stream('crew_flight_time.pdf');
    }

    public function assignedCrewPDF(Request $request)
    {
        $query = AirTraffic::query()->with('aircraft', 'flight', 'captain', 'first_official');
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];

        $counter = 1;

        if (!empty($fecha_inicial)) {
            $query->whereDate('flight_date', '>=', $fecha_inicial);
        }

        if (!empty($fecha_final)) {
            $query->whereDate('flight_date', '<=', $fecha_final);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return response()->json(['error' => 'No se encontraron registros.'], 404);
        }

        // Obtener las fechas inicial y final reales de los registros encontrados
        $real_fecha_inicial = $results->min('created_at');
        $real_fecha_final = $results->max('created_at');

        $pdf = PDF::loadView('reports.assigned_crews', compact('results', 'counter', 'real_fecha_inicial', 'real_fecha_final'))->setPaper('letter', 'landscape');

        return $pdf->stream('assigned_crews.pdf');
    }
}
