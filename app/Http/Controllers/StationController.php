<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Station::with(['createdBy', 'updatedBy'])->get();
        return view('config.stations.stations', compact('data'));
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
        Station::create($request->all());
        return redirect()->route('stations.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        //
        return view('config.stations.index', ['station' => $station]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        //
        $station->update($request->all());
        return redirect()->route('stations.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('station', $id)) {
          return back()->with('success', 'El registro se ha actualizado exitosamente!'); 
        }

    }
}
