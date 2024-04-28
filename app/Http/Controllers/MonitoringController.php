<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Employee;
use App\Models\Flight;
use App\Models\Department;
use App\Models\Monitoring;
use App\Models\Position;
use App\Models\Position_Details;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('monitoring.monitoring'/* , compact('data') */);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        return view('monitoring.create', compact('aircrafts', 'flights', 'crew_members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }
}
