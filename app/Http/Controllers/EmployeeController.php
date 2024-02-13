<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Office;
use App\Models\Department;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Employee::with(['createdBy', 'updatedBy', 'departments', 'offices', 'contracts'])->get();
        return view('employees.employees', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cities = City::get();
        $offices = Office::get();
        $departments = Department::get();
        $contracts = Contract::get();
        return view('employees.create', compact('cities', 'offices', 'departments', 'contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /* if($request->hasFile('photo')){
            $request['photo']=$request->file('photo')->store('uploads', 'public');
        }
        
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'El registro se ha añadido exitosamente!'); */
        $data = request()->except('_token');
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'El registro se ha añadido exitosamente!');
        /* return response()->json($data); */
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        $cities = City::get();
        $offices = Office::get();
        $departments = Department::get();
        $contracts = Contract::get();
        return view('employees.edit', ['employee' => $employee], compact('cities', 'offices', 'departments', 'contracts'));
        /* return dd($employee); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $data = request()->except(['_token', '_method']);

        if ($request->hasFile('photo')) {
            Storage::delete('public/' . $employee->photo);
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'El registro se ha añadido exitosamente!');
        /* return response()->json($data); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($this->toggleStatus('employee', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }

    public function viewProfile($id)
    {
        $employee = Employee::with(['createdBy', 'updatedBy', 'departments', 'offices', 'contracts'])->find($id);
        return view('employees.profile', compact('employee'));
    }
}
