<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:crews.index');
    }
    public function index()
    {
        //
        $department = Department::where('department', "Tripulación")->get();
        $data = Employee::where('department_id', $department[0]->id )->get();
        return view('crews.crews', compact('data'));
        //return dd($data);
    }
    
}
