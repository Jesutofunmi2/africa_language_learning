<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public function school()
    {
        return $this->hasMany(School::class);
    }

    public function assignedModule()
    {
        return $this->hasMany(AssignedModules::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function language()
    {
        return $this->hasMany(Language::class); 
    }
    public function classarm()
    {
        return $this->hasMany(ClassArm::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }

}
