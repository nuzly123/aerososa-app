<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft_Types extends Model
{
    use HasFactory;
    public $table = 'aircraft_types';
    protected $fillable = [
        'type', 
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


}
