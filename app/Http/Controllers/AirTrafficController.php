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
use App\Models\FlightTime;
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

    public function __construct()
    {
        $this->middleware('can:air_traffic.index');
    }

    public function index()
    {
        //
        $date = Carbon::today()->toDateString();
        $data = AirTraffic::with(['createdBy', 'updatedBy', 'flight', 'captain', 'first_official', 'flightAssistants', 'fueling'])
            ->whereDate('created_at', $date)->get();
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

        return view('air_traffic.air_traffic', compact('data', 'date', 'flight_status_array', 'flight_status_classes'));
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
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->where('status', 1)->get();
            }
        }

        return view('air_traffic.create', compact('aircrafts', 'flights', 'crew_members', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('refueling', 'approved_by');

        

        $registration = Aircraft::where('id', $data['aircraft_id'])->value('registration');
        $flight_code = Flight::where('id', $data['flight_id'])->value('code');
        $date   = date('Y-m-d H:i:s');
        
        
        //formar codigo de referencia de gaseo MATRICULA, NUMERO VUELO, FECHA VUELO
        $reference = $registration . ' ' . $flight_code . ' ' . $date;
        $caracteres = array('-', ':', ' ');
        $newReference = str_replace($caracteres, '', $reference); //limpia la cadena de los caracteres especiales

        $data['reference'] = $newReference; //guarda la referencia
        //return dd($data);
        
        
        AirTraffic::create($data);

        //$employee_id = Employee::max('id');
        $airTraffic_id = AirTraffic::max('id');

        $registro = AirTraffic::where('id', $airTraffic_id)->get();

        //REGISTRO DE GASEO
        //datos de otras tablas
        if (isset($request['refueling_amount'])) {
            if ($request['refueling_amount'] > 0) {
                //crear registro de gaseo
                Fueling::create([
                    'fuel_amount' => $request['refueling_amount'],
                    'approved_by' => $request['approved_by'], 'user_create' => $request['user_create'],
                    'user_update' => $request['user_update'], 'aircraft_id' => $request['aircraft_id'],
                    'airport_id' => $request['airport_id'],
                ]);

                $fueling_id = Fueling::max('id'); //trae el ultimo id registrado

                AirTraffic::where('id', $airTraffic_id)->update(['fueling_id' => $fueling_id]); //actualiza el campo de la referencia de gaseo en la BD
            }
        }
        //ACTUALIZACION DE REMANENTES
        $residual_fuel_amount = $request['initial_fuel'] - $request['fuel_consumption'];
        ResidualFuel::where('aircraft_id', $registro[0]['aircraft_id'])->update(['residual_fuel_amount' => $residual_fuel_amount, 'air_traffic_id' => $airTraffic_id]);


        //REGISTRO DE ASISTENTES DE VUELO
        // Obtener los IDs de los tripulantes seleccionados desde el formulario
        $flightAssistants = $request->input('flight_assistant_id');

        if (isset($flightAssistants)) {
            // Guardar los registros de los tripulantes en la tabla intermedia
            foreach ($flightAssistants as $flightAssistantId) {
                FlightAssistantDetails::create(['flight_assistant_id' => $flightAssistantId, 'air_traffic_id' => $airTraffic_id]);
            }
        }


        //TIEMPO DE VUELO DE PILOTOS
        //el tiempo de vuelo se define segun flight_route_id y aicraft_type_id
        $flight_route_id = FlightRoute::where('route', $request['flight_route'])->value('id'); //obtengo el id de la ruta
        $aircraft = Aircraft::where('id', $request['aircraft_id'])->value('aircraft_type_id'); //obtengo aeronave seleccionada
        $aircraft_type_id = AircraftType::where('id', $aircraft)->value('id');

        //obtengo el tiempo segun los datos anteriores
        $flight_time = FlightRouteDetail::where('route_id', $flight_route_id)->where('aircraft_type_id', $aircraft_type_id)->value('time');

        //guardo en la tabla de tiempos

        $pilots = [
            0 => $request['captain_id'],
            1 => $request['first_official_id'],
        ];
        foreach ($pilots as $pilot_id) {
            FlightTime::create([
                'air_traffic_id' => $airTraffic_id, 'employee_id' => $pilot_id,
                'pilot_flight_time' => $flight_time, 'user_create' => $request['user_create'],
                'user_update' => $request['user_update'],
            ]);
        }

        $registrotiempo = FlightTime::max('id');
        // Redireccionar o realizar cualquier otra acción necesaria después de guardar los datos
        return redirect()->route('air_traffic.index')->with('success', 'Registro de tráfico aéreo creado exitosamente.');

        //dd($request);
        //return dd('creado');
        //echo $registrotiempo;
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
        if (isset($flight_assistants)) {
            DB::table('flight_assistant_details')
                ->where('air_traffic_id', $airTraffic->id)
                ->delete();

            foreach ($flight_assistants as $flight_assistant) {
                FlightAssistantDetails::create(['flight_assistant_id' => $flight_assistant, 'air_traffic_id' => $airTraffic->id]);
            }
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

    public function Filter(Request $request)
    {
        $date = $request->input('date');
        $data = AirTraffic::whereDate('created_at', $date)->get();

        // Define el array asociativo para los estados de vuelo y sus clases CSS correspondientes
        $flight_status_classes = [
            0 => 'badge bg-warning',  // MATRICULA
            1 => 'badge bg-success',  // ON-TIME
            2 => 'badge bg-danger',   // DELAYED
            3 => 'badge bg-primary'   // ADELANTADO
        ];

        // Define el array asociativo para los textos de los estados de vuelo
        $flight_status_array = [
            0 => 'MATRICULA',
            1 => 'ON-TIME',
            2 => 'DELAYED',
            3 => 'ADELANTADO'
        ];

        //return dd($date);
        return view('air_traffic.air_traffic', compact('data', 'date', 'flight_status_array', 'flight_status_classes'));
    }
}
