<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidualFuel extends Model
{
    use HasFactory;
    public $table = 'residual_fuel';

    protected $fillable = [
        'aircraft_id', 
        'air_traffic_id', 
        'residual_fuel_amount'
    ];

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class, 'aircraft_id');
    }

    public function air_traffic()
    {
        return $this->belongsTo(AirTraffic::class, 'air_traffic_id');
    }
}
