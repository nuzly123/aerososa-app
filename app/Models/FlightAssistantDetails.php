<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightAssistantDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'flight_assistant_id',
        'air_traffic_id'
    ];

    public function air_traffic()
    {
        return $this->belongsTo(AirTraffic::class);
    }
    
    public function flight_assistant()
    {
        return $this->belongsTo(Employee::class, 'flight_assistant_id', 'id');
    }
    
}
