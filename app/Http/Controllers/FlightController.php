<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\City;
use App\Models\FlightRoute;
use Illuminate\Http\Request;
use Carbon\Carbon;


class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:flights.index')->only('index');
        $this->middleware('can:flights.create')->only('create');
        $this->middleware('can:flights.edit')->only('edit');
    }
    public function index()
    {
        //
        $data = Flight::with(['createdBy', 'updatedBy', 'flightRoute'])->get();
        $routes = FlightRoute::get();
        $cities = City::get();
        return view('config.flights.flights', compact('data', 'cities', 'routes'));
        //return dd($routes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = request()->except('_token', 'flight_time');
        $flight_time = $request->input('flight_time');

        Flight::create(array_merge($data, ['flight_time' => $flight_time]));

        return redirect()->route('config.flights.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        //
        $flight->update($request->all());
        //$request->all();
        //return dd($flight);
        //return dd($request);
        return redirect()->route('config.flights.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('flights', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }

    public function getFlightRoute($id)
    {
        // Obtiene el vuelo desde la base de datos
        $flight = Flight::findOrFail($id);

        /* // Obtiene los IDs de las ciudades de origen y destino del vuelo
        $originId = $flight->origin;
        $destinationId = $flight->destination;
        

        // Obtiene los nombres de las ciudades de origen y destino
        $originCity = City::findOrFail($originId)->code;
        $destinationCity = City::findOrFail($destinationId)->code;

        // Concatena las ciudades para formar la ruta del vuelo
        $route = $originCity . ' - ' . $destinationCity; */

        $response = [
            'departure_time' => Carbon::parse($flight->departure)->format('H:i'),
            'arrival_time' => Carbon::parse($flight->arrival)->format('H:i'),
            'flight_route' => $flight->flightRoute->route,
            // Agregar más respuestas si es necesario
        ];

        // Devuelve la ruta del vuelo como respuesta
        return response()->json($response);
        //dd($response);
    }

    public function getFlightStatus(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);
        $scheduledTime = $flight->departure;
        $realTime = $request->input('real_departure_time'); // Obtener la hora real de salida del vuelo desde la solicitud
        $result = $this->determineFlightStatus($scheduledTime, $realTime);
        $response = [
            'index' => $result[0],
            'status' => $result[1],
            'arrival' => $this->calculateArrivalTime($id, $realTime)
        ];
        return response()->json($response);
        //dd($response);
    }


    function determineFlightStatus($scheduledTime, $realTime)
    {
        // Convertir las horas programada y real a timestamps
        $scheduledTimestamp = strtotime($scheduledTime);
        $realTimestamp = strtotime($realTime);

        // Calcular los límites de tiempo
        $adelantadoLimite = strtotime('-30 minutes', $scheduledTimestamp);
        $onTimeInicio = strtotime('-9 minutes', $scheduledTimestamp);
        $onTimeFin = strtotime('+6 minutes', $scheduledTimestamp);
        $delayedInicio = strtotime('+6 minutes', $scheduledTimestamp);
        $delayedFin = strtotime('+60 minutes', $scheduledTimestamp);

        // Comparar la hora real con los límites de tiempo y determinar el estado del vuelo
        if ($realTimestamp < $adelantadoLimite || $realTimestamp > $delayedFin) {
            return [0, 'MATRICULA'];
        } elseif ($realTimestamp >= $onTimeInicio && $realTimestamp <= $onTimeFin) {
            return [1, 'ON-TIME'];
        } elseif ($realTimestamp > $delayedInicio && $realTimestamp <= $delayedFin) {
            return [2, 'DELAYED'];
        } else {
            return [3, 'ADELANTADO'];
        }
    }

    function calculateArrivalTime($id, $realTime)
    {
        $flight = Flight::findOrFail($id);
        $flight_time = Carbon::parse($flight->flight_time);

        $departureTime = Carbon::parse($realTime);
        $arrivalTime = $departureTime->copy()->addHours($flight_time->hour)->addMinutes($flight_time->minute);

        return $arrivalTime->format('H:i:s');
    }
}
