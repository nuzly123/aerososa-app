<?php

namespace App\Http\Controllers;

use App\Models\AirTraffic;
use App\Models\Aircraft;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\FlightAssistantDetails;
use App\Models\Position;
use App\Models\Position_Details;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirTrafficController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = AirTraffic::with(['createdBy', 'updatedBy', 'flight', 'captain', 'first_official', 'flightAssistants'])->get();
        $flight_status_array = [
            0 => "MATRICULA",
            1 => "ON-TIME",
            2 => "DELAYED",
            3 => "ADELANTADO"
        ];
        return view('air_traffic.air_traffic', compact('data', 'flight_status_array'));
        //dd($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $aircrafts = Aircraft::where('status', 1)->get();
        $flights = Flight::where('status', 1)->get();

        // Obtener IDs de los empleados para cada posición
        $positions = [
            'capitan' => Position::where('position', "Capitán")->first(),
            'primer_oficial' => Position::where('position', "Primer Oficial")->first(),
            'tripulante_cabina' => Position::where('position', "Tripulante de Cabina")->first()
        ];

        $crew_members = [];

        foreach ($positions as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->get();
            } else {
                // Manejar el caso en el que no se encuentre ninguna posición
                // Por ejemplo, redirigir a una página de error o mostrar un mensaje de error.
            }
        }

        return view('air_traffic.create', compact('aircrafts', 'flights', 'crew_members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        AirTraffic::create($request->all());

        //$employee_id = Employee::max('id');
        $airTraffic_id = AirTraffic::max('id');

        // Obtener los IDs de los tripulantes seleccionados desde el formulario
        $flightAssistants = $request->input('flight_assistant_id');

        // Guardar los registros de los tripulantes en la tabla intermedia
        foreach ($flightAssistants as $flightAssistantId) {
            FlightAssistantDetails::create(['flight_assistant_id' => $flightAssistantId, 'air_traffic_id' => $airTraffic_id]);
        }

        // Redireccionar o realizar cualquier otra acción necesaria después de guardar los datos
        return redirect()->route('air_traffic.index')->with('success', 'Registro de tráfico aéreo creado exitosamente.');

        //dd($request->all());
        //return dd('creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(AirTraffic $airTraffic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AirTraffic $airTraffic)
    {
        //
        $aircrafts = Aircraft::where('status', 1)->get();
        $flights = Flight::where('status', 1)->get();
        $flight_assistants = FlightAssistantDetails::all();

        // Obtener IDs de los empleados para cada posición
        $positions = [
            'capitan' => Position::where('position', "Capitán")->first(),
            'primer_oficial' => Position::where('position', "Primer Oficial")->first(),
            'tripulante_cabina' => Position::where('position', "Tripulante de Cabina")->first()
        ];

        $crew_members = [];

        foreach ($positions as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->get();
            } else {
                // Manejar el caso en el que no se encuentre ninguna posición
                // Por ejemplo, redirigir a una página de error o mostrar un mensaje de error.
            }
        }

        $flight_status_array = [
            0 => "MATRICULA",
            1 => "ON-TIME",
            2 => "DELAYED",
            3 => "ADELANTADO"
        ];



        return view('air_traffic.edit', ['air_traffic' => $airTraffic], compact('aircrafts', 'flights', 'crew_members', 'flight_status_array', 'flight_assistants'));
        //dd($airTraffic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AirTraffic $airTraffic)
    {
        //
        $data = request()->except(['_token', '_method']);
        $airTraffic->update($data);

        $flight_assistants = $request->input('flight_assistant_id'); //obtengo los flight_assistants

        DB::table('flight_assistant_details')
            ->where('air_traffic_id', $airTraffic->id)
            ->delete();

        foreach ($flight_assistants as $flight_assistant) {
            FlightAssistantDetails::create(['flight_assistant_id' => $flight_assistant, 'air_traffic_id' => $airTraffic->id]);
        }

        return redirect()->route('air_traffic.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AirTraffic $airTraffic)
    {
        //
    }
}
