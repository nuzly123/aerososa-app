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
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:admin.users.index');
    }

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
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->except(['_token', '_method', 'role']);
        User::create($data);
        /* $user->roles->sync($request->role); */
        return redirect()->route('admin.users.index')->with('success', 'El registro se ha añadido exitosamente!');
        
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
        $roles = Role::all();        
        return view('users.edit', ['user' => $user], compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $data = request()->except(['_token', '_method']);

        /* return dd($data); */

        $user->update($data);
        $user->roles()->sync($request->role);
        return redirect()->route('admin.users.index')->with('success', 'El usuario se ha actualizado exitosamente!');
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
        if ($this->toggleStatus('user', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }

    /* public function viewProfile($id)
    {
        $employee = Employee::with(['createdBy', 'updatedBy', 'departments', 'offices', 'contracts'])->find($id);
        return view('employees.profile', compact('employee'));
    } */
}
