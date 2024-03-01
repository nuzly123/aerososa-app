<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    public $table = 'aircrafts';

    protected $fillable = [
        'registration', 
        'aircraft_type_id',
        'img', 
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

    public function types()
    {
        return $this->belongsTo(AircraftType::class, 'aircraft_type_id');
    }
}
