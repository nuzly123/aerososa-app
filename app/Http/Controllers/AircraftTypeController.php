<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\AircraftType;
use Illuminate\Http\Request;

class AircraftTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = AircraftType::with(['createdBy', 'updatedBy'])->get();
        return view('config.aircrafts.types.aircraft_types', compact('data'));
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
        AircraftType::create($request->all());
        return redirect()->route('aircraft_types.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AircraftType $aircraft_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AircraftType $aircraft_type)
    {
        //
        return view('config.aircrafts.type.index', ['type' => $aircraft_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AircraftType $aircraft_type)
    {
        //
        $aircraft_type->update($request->all());
        return redirect()->route('aircraft_types.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AircraftType $city)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($result = $this->toggleStatus('aircraft_types', $id)) {
          return back()->with('success', 'El registro se ha actualizado exitosamente!'); 
        }

        //dd($result = $this->toggleStatus('aircraft_types', $id));
    }
}
