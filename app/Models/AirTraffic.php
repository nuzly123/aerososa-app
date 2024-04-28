<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirTraffic extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_date',
        'flight_id',
        'aircraft_id',
        'departure',
        'arrival',
        'flight_route',
        'flight_status',
        'px',
        'dh',
        'inf',
        'total_passengers',
        'captain_id',
        'first_official_id',
        'obsservant',
        'px_lbs',
        'freight',
        'trans_weight',
        'total_lbs',
        'trans_tgu',
        'trans_sap',
        'trans_rtb',
        'trans_lce',
        'remark',
        'user_create',
        'user_update',
    ];

    /* public function flight_assistant()
    {
        return $this->hasMany(FlightAssistantDetails::class, 'employee_id', 'id');
    } */

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class, 'aircraft_id');
    }

    public function captain()
    {
        return $this->belongsTo(Employee::class, 'captain_id');
    }

    public function first_official()
    {
        return $this->belongsTo(Employee::class, 'first_official_id');
    }

    public function flightAssistantDetails()
    {
        return $this->hasMany(FlightAssistantDetails::class);
    }

    public function flightAssistants()
    {
        return $this->belongsToMany(Employee::class, 'flight_assistant_details', 'air_traffic_id', 'flight_assistant_id');
    }
}
