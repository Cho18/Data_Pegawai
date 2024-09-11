<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile',
        'name',
        'gender',
        'address',
        'division',
        'level',
        'position',
        'salary',
        'hire_date',
    ];
}
