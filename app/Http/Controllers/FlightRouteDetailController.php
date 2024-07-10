<?php

namespace App\Http\Controllers;

use App\Models\AircraftType;
use App\Models\FlightRoute;
use App\Models\FlightRouteDetail;
use Illuminate\Http\Request;

class FlightRouteDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:config.flight_route_details.index');
    }

    public function index()
    {
        //
        $data = FlightRouteDetail::with(['createdBy', 'updatedBy', 'aircraftType'])->get();
        $routes = FlightRoute::get();
        $aircraftTypes = AircraftType::get();
        return view('config.flight_route_details.flight_route_details', compact('data', 'routes', 'aircraftTypes'));
        //dd($routes);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
