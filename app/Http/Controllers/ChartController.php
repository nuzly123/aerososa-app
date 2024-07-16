<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\AirTraffic;
use App\Models\Fueling;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function flightsChartData()
    {
        // Obtener el primer y último día del mes actual
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Consultar los vuelos del mes actual
        $flights = AirTraffic::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Agrupar por ruta de vuelo y contar
        $routesCount = $flights->groupBy('flight_route')->map->count();

        return response()->json($routesCount);
    }

    public function fuelingsChartData()
    {
        // Obtener el primer y último día del mes actual
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Consultar los gaseos del mes actual, incluyendo la relación con aeronave (aircraft)
        $fuelings = Fueling::with('aircraft')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Calcular el total de gaseo por aeronave
        $fuelingsByAircraft = $fuelings->groupBy('aircraft_id')
            ->map(function ($items) {
                return $items->sum('fuel_amount');
            });

        // Obtener nombres de las aeronaves y cantidades de gaseo para el gráfico
        $aircraftNames = [];
        $fuelAmounts = [];

        foreach ($fuelingsByAircraft as $aircraftId => $totalFuel) {
            $aircraft = Aircraft::find($aircraftId); // Asumiendo que tienes un modelo Aircraft
            if ($aircraft) {
                $aircraftNames[] = $aircraft->registration;
                $fuelAmounts[] = $totalFuel;
            }
        }

        return response()->json([
            'aircraft_names' => $aircraftNames,
            'fuel_amounts' => $fuelAmounts,
        ]);
        /* return dd($aircraftNames); */
    }
}
