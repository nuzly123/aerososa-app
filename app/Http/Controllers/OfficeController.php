<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Office::with(['createdBy', 'updatedBy', 'cities', 'stations'])->get();
        return view('config.offices.offices', compact('data'));
        //return dd($data);
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
        Office::create($request->all());
        return redirect()->route('offices.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
        return view('config.offices.index', ['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        //
        $office->update($request->all());
        return redirect()->route('offices.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('office', $id)) {
          return back()->with('success', 'El registro se ha actualizado exitosamente!'); 
        }

    }
}
