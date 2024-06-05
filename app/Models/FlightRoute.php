<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightRoute extends Model
{
    use HasFactory;
    public $table = 'flight_routes';
    protected $fillable = [
        'route',
        'origin_city_id',
        'destination_city_id',
        'user_create',
        'user_update',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(FlightRouteDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function originCity()
    {
        return $this->belongsTo(City::class, 'origin_city_id', 'id');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destination_city_id', 'id');
    }
}
