<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\FlightRoute;
use Illuminate\Http\Request;

class FlightRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = FlightRoute::with(['createdBy', 'updatedBy', 'originCity', 'destinationCity'])->get();
        $cities = City::get();
        return view('config.flight_routes.flight_routes', compact('data', 'cities'));
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
        $data = request()->except('_token');
        FlightRoute::create($data);

        return redirect()->route('flight_routes.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlightRoute $flight_route)
    {
        //
        $flight_route->update($request->all());
        return redirect()->route('flight_routes.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('flightroutes', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }
}
