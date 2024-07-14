<?php

namespace App\Exports;

use App\Models\Fueling;
use Maatwebsite\Excel\Concerns\FromCollection;

class FuelingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fueling::all();
    }
}
