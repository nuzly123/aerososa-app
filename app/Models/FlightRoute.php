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
}
