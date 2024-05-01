<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightRouteDetail extends Model
{
    use HasFactory;
    protected $fillable = ['route_id', 'aircraft_type_id', 'time', 'fuel'];

    public function route()
    {
        return $this->belongsTo(FlightRoute::class);
    }

    public function aircraftType()
    {
        return $this->belongsTo(AircraftType::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }
}
