<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'code',
        'flight_route_id',
        'departure',
        'arrival',
        'frecuency',
        'flight_time',
        'user_create',
        'user_update',
        'status'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function flightRoute()
    {
        return $this->belongsTo(FlightRoute::class, 'flight_route_id');
    }

}
