<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Office;
use App\Models\Department;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index()
    {
        //
        $data = User::with(['createdBy', 'updatedBy'])->get();
        return view('users.users', compact('data'));
        //return response()->json($data);
        //return dd($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cities = City::where('status', 1)->get();
        //$offices = Office::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $contracts = Contract::where('status', 1)->get();
        return view('users.create', compact('cities', /* 'offices', */ 'departments', 'contracts'));
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
        User::create($data);
        return redirect()->route('Users.index')->with('success', 'El registro se ha añadido exitosamente!');
        /* return response()->json($data); */
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $cities = City::get();
        $offices = Office::get();
        $departments = Department::get();
        $contracts = Contract::get();
        return view('users.edit', ['user' => $user], compact('cities', 'offices', 'departments', 'contracts'));
        /* return dd($employee); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $data = request()->except(['_token', '_method']);

        if ($request->hasFile('photo')) {
            Storage::delete('public/' . $user->photo);
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'El registro se ha añadido exitosamente!');
        /* return response()->json($data); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
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
