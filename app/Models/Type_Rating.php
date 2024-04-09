<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Rating extends Model
{
    use HasFactory;
    protected $fillable = 
    ['code',
    'user_create', 
    'user_update', 
    'status'
    ];
}
