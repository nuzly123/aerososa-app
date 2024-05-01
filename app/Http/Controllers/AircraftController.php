<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\ResidualFuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$data = Aircraft::with(['createdBy', 'updatedBy'])->get();
        $data = Aircraft::with(['createdBy', 'updatedBy', 'types', 'residual_fuel'])->get();
        $types = AircraftType::where('status', 1)->get();
        return view('aircrafts.aircrafts', compact('data', 'types'));
        //dd($data[0]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('aircrafts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = request()->except('_token', 'residual_fuel_amount');

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('uploads', 'public');
        }else{
            $data['img'] = "uploads/default-photo.jpg";
        }
        Aircraft::create($data); //se creo el registro

        //crear registro de remanente
        $residual_fuel = $request->input('residual_fuel_amount');
        $aircraft_id = Aircraft::max('id');
        ResidualFuel::create(['residual_fuel_amount' => $residual_fuel, 'aircraft_id' => $aircraft_id]); //registro creado


        return redirect()->route('aircrafts.index')->with('success', 'El registro se ha añadido exitosamente!');
        //return dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aircraft $aircraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aircraft $aircraft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aircraft $aircraft)
    {
        //
        $data = request()->except(['_token', '_method']);
        if ($request->hasFile('img')) {
            Storage::delete('public/' . $aircraft->img);
            $data['img'] = $request->file('img')->store('uploads', 'public');
        }
        
        //return dd($data);
        $aircraft->update($data);

        //dd($aircraft->residual_fuel_id);
        //borrando los registros de detalles creados en la BD
        DB::table('residual_fuel')
            ->where('id', $aircraft->residual_fuel_id)
            ->where('aircraft_id', $aircraft->id)
            ->delete();

        $residual_fuel = $request->input('residual_fuel_amount');
        ResidualFuel::create(['residual_fuel_amount' => $residual_fuel, 'aircraft_id' => $aircraft->id]); //registro creado


        $data['residual_fuel_id'] = ResidualFuel::max('id');

        $aircraft->update($data);

        return redirect()->route('aircrafts.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aircraft $aircraft)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('aircrafts', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }
}
