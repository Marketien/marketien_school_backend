<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'name',
        'fatherName',
        'motherName',
        'birthDate',
        'phoneNo',
        'email',
        'image',
        'address',
        'class',
        'section',
        'rollNo',
        'regNo',
        'password',

    ];
}
