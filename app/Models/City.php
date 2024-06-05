<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'code', 'user_create', 'user_update', 'status'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    /* public function flightsFrom()
    {
        return $this->hasMany(FlightRoute::class, 'origin_city_id');
    }

    public function flightsTo()
    {
        return $this->hasMany(FlightRoute::class, 'destination_city_id');
    } */
}
