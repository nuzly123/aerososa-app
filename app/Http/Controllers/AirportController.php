<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:config.aiports.index');
    }

    public function index()
    {
        //
        //$data = DB::select("SELECT * FROM AIRPORTS");
        $data = Airport::with(['createdBy', 'updatedBy'])->get();

        //return view('config.airports.airports')->with("data", $data);
        //return response()->json($data);
        //return dd($data);
        return view('config.airports.airports', compact('data'));
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
    public function store(Request $request): RedirectResponse
    {
        //
        //$dataRequest = request()->all();
        //return response()->json($dataRequest);

        Airport::create($request->all());
        return redirect()->route('config.airports.index')->with('success', 'El registro se ha añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {
        //
        return view('config.airports.index', ['airport' => $airport]);
        //return dd($airport);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        //
        $airport->update($request->all());
        return redirect()->route('config.airports.index')->with('success', 'El registro se ha añadido exitosamente!');
        //return dd($airport);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        //
    }

    public function updateStatus($id)
    {
        if ($result = $this->toggleStatus('airports', $id)) {
            return back()->with('success', 'El registro se ha actualizado exitosamente!');
        }
    }
}
