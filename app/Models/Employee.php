<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = 
    ['dni',
    'name', 
    'last_name', 
    'phone', 
    'email', 
    'birth', 
    'address', 
    'position', 
    'photo',
    'entry_date', 
    'user_create', 
    'user_update', 
    'status',
    'department_id',
    'office_id',
    'contract_id'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function offices()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function contracts()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function positions()
    {
        return $this->hasMany(Position_Details::class, 'employee_id', 'id');
    }
    public function isCrew()
    {
        return $this->hasMany(Employee_Crew::class, 'employee_id', 'id');
    }

    public function flightAssistantDetails()
    {
        return $this->hasMany(FlightAssistantDetails::class);
    }
}
