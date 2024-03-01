<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\AircraftType;
use Illuminate\Http\Request;

class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$data = Aircraft::with(['createdBy', 'updatedBy'])->get();
        $data = Aircraft::with(['createdBy', 'updatedBy', 'types'])->get();
        $types = AircraftType::where('status', 1)->get();
        return view('aircrafts.aircrafts', compact('data', 'types'));
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
        $data = request()->except('_token');
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('uploads', 'public');
        }else{
            $data['img'] = "uploads/default-photo.jpg";
        }
        //Aircraft::create($data);
        //return redirect()->route('aircrafts.index')->with('success', 'El registro se ha añadido exitosamente!');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aircraft $aircraft)
    {
        //
    }
}
