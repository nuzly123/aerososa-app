<?php

namespace App\Exports;

use App\Models\AirTraffic;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AirTrafficExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = AirTraffic::query()->with('flight', 'aircraft', 'captain', 'first_official', 'flightAssistants'); // Cargar las relaciones

        // Aplicar filtros a la consulta
        if (!empty($this->filters['flight_date'])) {
            $query->whereDate('flight_date', $this->filters['flight_date']);
        }

        if (!empty($this->filters['aircraft_id'])) {
            $query->where('aircraft_id', $this->filters['aircraft_id']);
        }
        if (!empty($this->filters['flight_route'])) {
            $query->where('flight_route', '=', $this->filters['flight_route']);
        }

        if (!empty($this->filters['captain_id'])) {
            $query->where('captain_id', $this->filters['captain_id']);
        }

        if (!empty($this->filters['first_official_id'])) {
            $query->where('first_official_id', $this->filters['first_official_id']);
        }


        return $query;
    }

    /* public function collection()
    {
        //return AirTraffic::all();
        //return AirTraffic::with('flight', 'aircraft', 'captain', 'first_official')->get();
    } */

    public function map($airTraffic): array
    {
        $flight_status_array = [
            0 => "MATRICULA",
            1 => "ON-TIME",
            2 => "DELAYED",
            3 => "ADELANTADO"
        ];

        $fueling = $airTraffic->fueling->where('air_traffic_id', $airTraffic->id)->first();

        $flightAssistantNames = [];
        foreach ($airTraffic->flightAssistants as $flightAssistant) {
            $flightAssistantNames[] = $flightAssistant->name . ' ' . $flightAssistant->last_name;
        }

        $flightAssistantNamesString = implode(', ', $flightAssistantNames);

        return [
            $airTraffic->reference,
            $airTraffic->flight_date,
            $airTraffic->aircraft->registration,
            $airTraffic->flight->code,
            $airTraffic->flight->flightRoute->route,
            $airTraffic->departure,
            $flight_status_array[$airTraffic->flight_status],
            $airTraffic->arrival,
            $airTraffic->px ? $airTraffic->px : '0',
            $airTraffic->dh ? $airTraffic->dh : '0',
            $airTraffic->inf ? $airTraffic->inf : '0',
            $airTraffic->total_passengers ? $airTraffic->total_passengers : '0',
            $airTraffic->initial_fuel,
            $fueling ? $fueling->fuel_amount : '0',
            $airTraffic->fuel_consumption,
            $airTraffic->residual_fuel,
            $airTraffic->captain->name . ' ' . $airTraffic->captain->last_name,
            $airTraffic->first_official->name . ' ' . $airTraffic->first_official->last_name,
            $flightAssistantNamesString,
            $airTraffic->obsservant,
            $airTraffic->px_lbs ? $airTraffic->px_lbs : '0',
            $airTraffic->freight ? $airTraffic->freight : '0',
            $airTraffic->trans_weigth ? $airTraffic->trans_weigth : '0',
            $airTraffic->total_lbs ? $airTraffic->total_lbs : '0',
            $airTraffic->trans_tgu ? $airTraffic->trans_tgu : '0',
            $airTraffic->trans_sap ? $airTraffic->trans_tgu : '0',
            $airTraffic->trans_rtb ? $airTraffic->trans_tgu : '0',
            $airTraffic->trans_lce ? $airTraffic->trans_tgu : '0',
            $airTraffic->remark ? $airTraffic->remark : 'N/A',
            $airTraffic->createdBy->username,
            $airTraffic->updatedBy->username,
        ];
    }

    public function headings(): array
    {
        return [
            'Referencia',
            'Fecha de Vuelo',
            'Aeronave',
            'Vuelo',
            'Ruta',
            'Hora Salida',
            'Estado',
            'Hora Llegada',
            'Pasajeros',
            'DH',
            'Infantes',
            'Total Pasajeros',
            'Combustible Inicial',
            'Gaseo',
            'Consumo',
            'Remanente',
            'Capitán',
            'Primer Oficial',
            'Asistentes de Vuelo', // Añadido aquí
            'Observador',
            'Pasajeros (Lbs)',
            'Carga (Lbs)',
            'Tránsitos (Lbs)',
            'Total Libras',
            'Tránsitos TGU',
            'Tránsitos SAP',
            'Tránsitos RTB',
            'Tránsitos LCE',
            'Remarks',
            'Creado por',
            'Actualizado por'
        ];
    }
}
