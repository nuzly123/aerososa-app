<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:config.cities.index');
    }

    public function index()
    {
        //
        $data = City::with(['createdBy', 'updatedBy'])->get();
        return view('config.cities.cities', compact('data'));
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
        City::create($request->all());
        return redirect()->route('config.cities.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
        return view('config.cities.index', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
        $city->update($request->all());
        return redirect()->route('config.cities.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($result = $this->toggleStatus('cities', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }

        //dd($result = $this->toggleStatus('airports', $id));
    }
}
