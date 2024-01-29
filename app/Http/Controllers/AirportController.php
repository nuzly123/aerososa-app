<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=DB::select("SELECT * FROM AIRPORTS");
        return view('config.airports.airports')->with("data", $data);
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
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        //
    }
}
