<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:config.contracts.index');
    }

    public function index()
    {
        //
        $data = Contract::with(['createdBy', 'updatedBy'])->get();
        return view('config.contracts.contracts', compact('data'));
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
        Contract::create($request->all());
        return redirect()->route('config.contracts.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
        return view('config.contracts.index', ['contract' => $contract]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        //
        $contract->update($request->all());
        return redirect()->route('config.contracts.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($result = $this->toggleStatus('contracts', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }

        //dd($result = $this->toggleStatus('airports', $id));
    }
}
