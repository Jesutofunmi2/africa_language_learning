<?php

namespace App\Services;

use App\Models\ClassArm;
use Illuminate\Support\Facades\DB;

class ClassArmService
{
     public function createClassArm(array $data)
     {
        $school_id = $data['school_id'];
        $class_id = $data['class_id'];
        $language_id = $data['language_id'];

        $moduleDatas = collect($data['data'])->map(function ($classData) use ($school_id, $language_id, $class_id) {
            $classarm = new ClassArm;
            $classarm->name = $classData['name'];
            $classarm->school_id = $school_id;
            $classarm->classes_id = $class_id;
            $classarm->language_id = $language_id;
        
           $classarm->save();        
    
    });
}



     public function showClassArm(array $data)
     {
        $class = ClassArm::where('school_id', $data['school_id'])->get();

        return $class;
     }

     public function deleteClassArm(array $data)
     {
       $deleteClass = ClassArm::where('id', $data['teacher_id'])
                               ->where('school_id', $data['school_id'])
                               ->where('name', $data['name'])->delete();
                               
       return $deleteClass;
     }
}