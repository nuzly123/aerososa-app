<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Flight;
use App\Models\Monitoring;
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
        //
        $aircrafts = Aircraft::where('status', 1)->get();
        $flights = Flight::where('status', 1)->get();
        return view('monitoring.create', compact('aircrafts', 'flights'));
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
