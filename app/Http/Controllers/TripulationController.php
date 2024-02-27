<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class TripulationController extends Controller
{
    //
    public function index()
    {
        //
        $department = Department::where('department', "Tripulación")->get();
        $data = Employee::where('department_id', $department[0]->id )->get();
        return view('tripulations.tripulation', compact('data'));
        //return dd($data);
    }
}
