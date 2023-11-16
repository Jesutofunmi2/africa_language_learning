<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClassArm extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function class()
    {
        return $this->hasMany(Classes::class);
    }

    protected $fillable = [
        'student_id',
        'class_id',
        'classarm_id',
        'session',
        'term',
    ];
}
