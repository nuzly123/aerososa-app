<?php

namespace App\Exports;

use App\Models\Aircraft;
use Maatwebsite\Excel\Concerns\FromCollection;

class AircraftExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aircraft::all();
    }
}
