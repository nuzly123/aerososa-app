<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fueling extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuel_amount',
        'approved_by',
        'user_create',
        'user_update',
        'aircraft_id',
        'airport_id',
        'air_traffic_id'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    public function airTraffic()
    {
        return $this->belongsTo(AirTraffic::class, 'air_traffic_id');
    }

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id');
    }

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class, 'aircraft_id');
    }
}
