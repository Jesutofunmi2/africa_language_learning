<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\TeacherClassArm;
use Illuminate\Support\Facades\DB;

class ClassService
{
     public function createClass(array $data):Classes
     {
       
        DB::transaction(function () use (&$class, $data) {
            $class = new Classes;
            $class->name = $data['class_room_name'];
            $class->school_id = $data['school_id'];
            $class->teacher_id = $data['teacher_id'] ?? null;
            $class->language_id = $data['language_id'];
            $class->save();

            //@todo we fire other actions after registration
        });

        return $class;
     }

     public function showTeacheClasses(array $data)
     {
        $class = TeacherClassArm::where('teacher_id',$data['teacher_id'])->get();
      

        return $class;
     }

     public function showClassSchool(array $data)
     {
        $class = Classes::where('school_id', $data['school_id'])->get();

        return $class;
     }
     public function showSingleClass(array $data)
     {
      $class = Classes::where('school_id', $data['school_id'])->where('id', $data['class_id'])->get();

      return $class; 
     }
     public function deleteTeacherClass(array $data)
     {
       $deleteClass = Classes::where('teacher_id', $data['teacher_id'])
                               ->where('school_id', $data['school_id'])
                               ->where('language_id', $data['language_id'])
                               ->where('id', $data['class_id'])->delete();
                               
       return $deleteClass;
     }
     public function deleteSchoolClass(array $data)
     {
       $deleteSchoolClass = Classes::where('id', $data['class_id'])
                                     ->where('school_id', $data['school_id'])->delete();
                               
       return $deleteSchoolClass;
     }

}