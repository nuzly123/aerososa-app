<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'air_traffic_id',
        'pilot_flight_time',
        'employee_id',
        'user_create',
        'user_update'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function airTraffic()
    {
        return $this->belongsTo(AirTraffic::class, 'air_traffic_id');
    }

    public function pilot()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


}
