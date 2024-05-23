<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_date',
        'aircraft_id',
        'flight_id',
        'captain_id',
        'first_official_id',
        'remark',
        'fueling_id',
    ];
}
