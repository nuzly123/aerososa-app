<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Position::with(['createdBy', 'updatedBy'])->get();
        return view('config.positions.positions', compact('data'));
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
        Position::create($request->all());
        return redirect()->route('positions.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
        return view('config.positions.index', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        //
        $position->update($request->all());
        return redirect()->route('positions.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('positions', $id)) {
          return back()->with('success', 'El registro se ha actualizado exitosamente!'); 
        }

    }
}
