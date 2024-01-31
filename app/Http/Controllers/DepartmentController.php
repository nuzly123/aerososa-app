<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Department::with(['createdBy', 'updatedBy'])->get();
        return view('config.departments.departments', compact('data'));
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
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
        return view('config.departments.index', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('department', $id)) {
          return back()->with('success', 'El registro se ha actualizado exitosamente!'); 
        }

        //dd($result = $this->toggleStatus('department', $id));
    }
}
