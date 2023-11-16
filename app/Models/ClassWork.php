<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_id',
        'school_id',
        'teacher_id'
    ];
}
