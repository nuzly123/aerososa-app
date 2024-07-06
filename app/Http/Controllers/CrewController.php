<?php

namespace App\Http\Controllers;

use App\Models\AirTraffic;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Employee_Crew;
use App\Models\Position;
use App\Models\Position_Details;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:crews.index');
    }

    public function index()
    {
        $crewData = $this->getCrewData();
        return view('crews.pilots', [
            'data' => $crewData['data'],
            'licenses' => $crewData['licenses'],
            'positions' => $crewData['positions'],
            'flight_assistants' => $crewData['flight_assistants'],
            'pilots' => $crewData['pilots']
        ]);
    }

    public function addLicense(Request $request)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'license' => 'required|string|max:255',
        ]);

        // Buscar el registro por ID y actualizarlo o crear uno nuevo si no existe
        $employee = Employee_Crew::updateOrCreate(
            ['employee_id' => $request->employee_id],
            $validatedData
        );

        $message = $employee->wasRecentlyCreated ? 'Licencia añadida exitosamente.' : 'Licencia actualizada exitosamente.';

        return redirect()->back()->with('status', $message);
    }

    public function addTypeRating(Request $request)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'license' => 'required|string|max:255',
        ]);

        // Buscar el registro por ID y actualizarlo o crear uno nuevo si no existe
        $employee = Employee_Crew::updateOrCreate(
            ['employee_id' => $request->employee_id],
            $validatedData
        );

        $message = $employee->wasRecentlyCreated ? 'Licencia añadida exitosamente.' : 'Licencia actualizada exitosamente.';

        return redirect()->back()->with('status', $message);
    }

    public function getPilots()
    {
        $crewData = $this->getCrewData();

        return view('crews.pilots', [
            'data' => $crewData['data'],
            'licenses' => $crewData['licenses'],
            'positions' => $crewData['positions'],
            'pilots' => $crewData['pilots']
        ]);
    }

    public function getFlightAssistants()
    {
        $crewData = $this->getCrewData();

        return view('crews.flight_assistants', [
            'data' => $crewData['data'],
            'licenses' => $crewData['licenses'],
            'positions' => $crewData['positions'],
            'flight_assistants' => $crewData['flight_assistants']
        ]);
    }

    /* private function getCrewData()
    {
        $department = Department::where('department', "Tripulación")->first();
        $data = Employee::where('department_id', $department->id)->orderBy('name', 'asc')->get();
        $licenses = Employee_Crew::all();

        $positions = [
            0 => "Tripulante de Cabina",
            1 => "Primer Oficial",
            2 => "Capitán",
        ];

        $positions_crew = [
            'Capitán' => Position::where('position', "Capitán")->first(),
            'Primer Oficial' => Position::where('position', "Primer Oficial")->first(),
            'Tripulante de Cabina' => Position::where('position', "Tripulante de Cabina")->first(),
        ];

        $crew_members = [];

        foreach ($positions_crew as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->get();
            }
        }

        $pilots = $crew_members['Capitán']->merge($crew_members['Primer Oficial']);
        $flight_assistants = $crew_members['Tripulante de Cabina'];

        return compact('data', 'licenses', 'positions', 'pilots', 'flight_assistants');
    } */

    private function getCrewData()
    {
        $department = Department::where('department', "Tripulación")->first();
        $data = Employee::where('department_id', $department->id)->orderBy('name', 'asc')->get();
        $licenses = Employee_Crew::all();

        $positions = [
            0 => "Tripulante de Cabina",
            1 => "Primer Oficial",
            2 => "Capitán",
        ];

        $positions_crew = [
            'Capitán' => Position::where('position', "Capitán")->first(),
            'Primer Oficial' => Position::where('position', "Primer Oficial")->first(),
            'Tripulante de Cabina' => Position::where('position', "Tripulante de Cabina")->first(),
        ];

        $crew_members = [];

        foreach ($positions_crew as $key => $position) {
            if ($position) {
                $crew_member_ids = Position_Details::where('position_id', $position->id)->pluck('employee_id')->toArray();
                $crew_members[$key] = Employee::whereIn('id', $crew_member_ids)->get();
            }
        }

        $pilots = $crew_members['Capitán']->merge($crew_members['Primer Oficial']);
        $flight_assistants = $crew_members['Tripulante de Cabina'];

        // Añadir última actividad de vuelo para cada miembro de la tripulación
        foreach ($pilots as $pilot) {
            $pilot->last_activity = AirTraffic::where('captain_id', $pilot->id)->orWhere('first_official_id', $pilot->id)->latest('created_at')->first();
        }

        /* foreach ($flight_assistants as $assistant) {
            $assistant->last_activity = AirTrafic::where('employee_id', $assistant->id)->latest('created_at')->first();
        } */

        return compact('data', 'licenses', 'positions', 'pilots', 'flight_assistants');
    }
}
