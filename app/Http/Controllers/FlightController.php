<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\City;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Flight::with(['createdBy', 'updatedBy', 'originCity', 'destinationCity'])->get();
        $cities = City::get();
        return view('config.flights.flights', compact('data', 'cities'));
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
        
        return redirect()->route('flights.index')->with('success', 'El registro se ha añadido exitosamente!');
        
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
        return redirect()->route('flights.index')->with('success', 'El registro se ha añadido exitosamente!');
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

        //dd($result = $this->toggleStatus('department', $id));
    }
}
