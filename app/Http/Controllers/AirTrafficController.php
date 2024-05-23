<?php

namespace App\Http\Controllers;

use App\Models\AirTraffic;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\Airport;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\FlightAssistantDetails;
use App\Models\FlightRoute;
use App\Models\FlightRouteDetail;
use App\Models\Fueling;
use App\Models\Position;
use App\Models\Position_Details;
use App\Models\ResidualFuel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

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
        $airports = Airport::where('status', 1)->get();

        /* $position = Position::where('position', "Despachador de Vuelo")->first(); //obtengo el id de la posicion
        $dispatcher_id = Position_Details::where('position_id', $position->id); //obtengo los id de empleados segun la posicion
        $dispatchers = Employee::where('status', 1)->where('id', $dispatcher_id);
 */
        // Obtener IDs de los empleados para cada posición
        $positions = [
            'capitan' => Position::where('position', "Capitán")->first(),
            'primer_oficial' => Position::where('position', "Primer Oficial")->first(),
            'tripulante_cabina' => Position::where('position', "Tripulante de Cabina")->first(),
            'despachador_vuelo' => Position::where('position', "Despachador de Vuelo")->first()
        ];

        $crew_members = [];

        foreach ($positions as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->get();
            }
        }

        return view('air_traffic.create', compact('aircrafts', 'flights', 'crew_members', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        AirTraffic::create($request->except('refueling', 'approved_by'));

        //$employee_id = Employee::max('id');
        $airTraffic_id = AirTraffic::max('id');

        $registro = AirTraffic::where('id', $airTraffic_id)->get();

        //datos de otras tablas
        $registration = Aircraft::where('id', $registro[0]['aircraft_id'])->value('registration');
        $flight_code = Flight::where('id', $registro[0]['flight_id'])->value('code');

        //formar codigo de referencia de gaseo MATRICULA, NUMERO VUELO, FECHA VUELO
        $reference = $registration . ' ' . $flight_code . ' ' . $registro[0]['created_at'];
        $caracteres = array('-', ':', ' ');
        $newReference = str_replace($caracteres, '', $reference); //limpia la cadena de los caracteres especiales

        //crear registro de gaseo
        Fueling::create([
            'reference' => $newReference, 'fuel_amount' => $request['refueling_amount'],
            'approved_by' => $request['approved_by'], 'user_create' => $request['user_create'],
            'user_update' => $request['user_update'], 'aircraft_id' => $request ['aircraft_id'],
            'airport_id' => $request['airport_id'],
        ]);

        $fueling_id = Fueling::max('id'); //trae el ultimo id registrado

        AirTraffic::where('id', $airTraffic_id)->update(['fueling_id' => $fueling_id]); //actualiza el campo de la referencia de gaseo en la BD

        // Obtener los IDs de los tripulantes seleccionados desde el formulario
        $flightAssistants = $request->input('flight_assistant_id');

        // Guardar los registros de los tripulantes en la tabla intermedia
        foreach ($flightAssistants as $flightAssistantId) {
            FlightAssistantDetails::create(['flight_assistant_id' => $flightAssistantId, 'air_traffic_id' => $airTraffic_id]);
        }

        // Redireccionar o realizar cualquier otra acción necesaria después de guardar los datos
        return redirect()->route('air_traffic.index')->with('success', 'Registro de tráfico aéreo creado exitosamente.');

        //dd($newReference);
        //return dd('creado');
        //echo $newReference;
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

    public function getFuelConsumption(Request $request)
    {
        $aircraftId = $request->aircraft_id;
        $route = $request->flight_route;

        //parametros
        $aircraftType = Aircraft::where('id', $aircraftId)->first()->aircraft_type_id; //obtiene el id que hace referencia al tipo de aeronave
        if (!$aircraftType) {
            return response()->json(['error' => 'No se encontró el tipo de aeronave correspondiente'], 404);
        }

        $routeId = FlightRoute::where('route', $route)->first()->id; //obtiene el id que hace referencia a la ruta
        if (!$routeId) {
            // Manejar el caso en que no se encuentra la ruta de vuelo
            return response()->json(['error' => 'No se encontró la ruta de vuelo correspondiente'], 404);
        }

        $fuelConsumption = FlightRouteDetail::where('route_id', $routeId)
            ->where('aircraft_type_id', $aircraftType)
            ->first()
            ->fuel;

        //dd($fuelConsumption);
        return response()->json(['fuel_consumption' => $fuelConsumption]);
    }

    public function getResidualFuel(Request $request)
    {
        $aircraftId = $request->aircraft_id;

        $residualFuel = ResidualFuel::where('aircraft_id', $aircraftId)
            ->first()
            ->residual_fuel_amount;

        return response()
            ->json(['residual_fuel' => $residualFuel]);
        //dd($residualFuel);
    }

    public function getInitialFuel(Request $request)
    {
        $refuelingAmount = $request->refueling_amount;
        $residualFuel  = $request->residual_fuel;

        /* refueling_amount: refuelingAmount,
            residual_fuel: residualFuel */

        $initialFuel = $refuelingAmount + $residualFuel;

        return response()->json(['initial_fuel' => $initialFuel]);
        //dd($initialFuel);
    }
}
