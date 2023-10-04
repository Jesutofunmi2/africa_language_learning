<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassArm extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }

}
