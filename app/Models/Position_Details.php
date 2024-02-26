<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position_Details extends Model
{
    use HasFactory;

    public $table = 'position_details';

    protected $fillable = [
        'id',
        'position_id',
        'employee_id'
    ];

    public function positions()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
