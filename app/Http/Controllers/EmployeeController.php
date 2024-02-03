<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Office;
use App\Models\Department;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;

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
        return view('employees.create',compact('cities', 'offices', 'departments', 'contracts'));
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
