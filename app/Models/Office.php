<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'office', 
        'code', 
        'extension',
        'phone', 
        'address', 
        'latitude', 
        'longitude', 
        'city_id', 
        'station_id', 
        'user_create', 
        'user_update', 
        'status'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function stations()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
}
