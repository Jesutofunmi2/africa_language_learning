<?php

namespace App\Services;

use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassService
{
     public function createClass(array $data):Classes
     {
       
        DB::transaction(function () use (&$class, $data) {
            $class = new Classes;
            $class->name = $data['class_room_name'];
            $class->school_id = $data['school_id'];
            $class->teacher_id = $data['teacher_id'];
            $class->language_id = $data['language_id'];
            $class->save();

            //@todo we fire other actions after registration
        });

        return $class;
     }


     public function showClass(array $data)
     {
        $class = Classes::where('teacher_id',$data['teacher_id'])->where('school_id', $data['school_id'])->get();

        return $class;
     }

     public function deleteClass(array $data)
     {
       $deleteClass = Classes::where('teacher_id',$data['teacher_id'])->where('school_id', $data['school_id'])->delete();

       return $deleteClass;
     }
}