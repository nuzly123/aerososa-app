<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Crew extends Model
{
    use HasFactory;
    public $table = 'employee_crews';
    protected $fillable = 
    ['license',
    'user_create', 
    'user_update', 
    'status',
    'employee_id'
    ];

    public function type_ratings()
    {
        return $this->hasMany(Employee_Crew_Type_Rating::class, 'employee_crew_id', 'id');
    }


    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
}
