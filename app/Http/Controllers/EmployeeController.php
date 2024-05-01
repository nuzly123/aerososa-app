<?php

namespace App\Http\Controllers;

use App\Models\Employee_Crew;
use App\Models\Office;
use App\Models\Department;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Position_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Employee::with(['createdBy', 'updatedBy', 'departments', 'offices', 'contracts', 'positions'])->get();


        return view('employees.employees', compact('data'));
        //return response()->json($data);
        //return dd($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $offices = Office::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $contracts = Contract::where('status', 1)->get();
        $positions = Position::where('status', 1)->get();
        return view('employees.create', compact('offices', 'departments', 'contracts', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('license_number') == null) {
            $data = request()->except('_token', 'license_number');
        } else {
            $data = request()->except('_token');
        }
        // return dd($data);

        //verifica si request trae un archivo(foto), si no, asigna una ruta de foto por default
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        } else {
            $data['photo'] = "uploads/default.png";
        }

        //creando empleado
        Employee::create($data);


        //creando detalles de cargo
        $position_values = $request->input('positions_array');
        $employee_id = Employee::max('id');
        foreach ($position_values as $position) {
            Position_Details::create(['position_id' => $position, 'employee_id' => $employee_id]);
        }
        
        if (isset($data['license_number'])) {
            Employee_Crew::create(['license' => $data['license_number'], 'employee_id' => $employee_id]);
        }

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
        $offices = Office::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $contracts = Contract::where('status', 1)->get();
        $positions = Position::where('status', 1)->get();
        $crews = Employee_Crew::where('employee_id', $employee->id)->get();
        return view('employees.edit', ['employee' => $employee], compact('offices', 'departments', 'contracts', 'positions', 'crews'));
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
        /*  return dd($data); */
        $employee->update($data);

        //actualizando tabla de detalles



        $position_values = $request->input('positions_array'); //obtengo los cargos o cargo

        //borrando los registros de detalles creados en la BD
        DB::table('position_details')
            ->where('employee_id', $employee->id)
            ->delete();

        //creando el nuevo registro o registros.
        foreach ($position_values as $position) {
            Position_Details::create(['position_id' => $position, 'employee_id' => $employee->id]);
        }

        $license_number = $request->input('license_number');

        Employee_Crew::create(['license' => $license_number, 'employee_id' => $employee->id]);

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
