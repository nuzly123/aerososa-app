<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Crew_Type_Rating extends Model
{
    use HasFactory;
    protected $fillable = 
    ['employee_crew_id',
    'type_rating_id',
    'user_create', 
    'user_update', 
    'status'
    ];

    public function type_ratings()
    {
        return $this->belongsTo(Type_Rating::class, 'type_rating_id');
    }
    
    public function employee_crew()
    {
        return $this->belongsTo(Employee_Crew::class, 'employee_crew_id', 'id');
    }
    
}
