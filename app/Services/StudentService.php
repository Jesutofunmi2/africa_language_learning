<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    /**
     * Create a school account.
     */
    public function createStudent(array $data): Student
    {
        $student = new Student;
        $password = '12345678';
        $data['password'] = $password;
            DB::transaction(function() use (&$student, $data) {
                $student->first_name = $data['first_name'];
                $student->last_name = $data['last_name'];
                $student->student_id = $data['student_id'];
                $student->school_id = $data['school_id'];
                $student->phone_number = $data['phone_number'];
                $student->password = Hash::make($data['password']); 
                $student->country = $data['country'];
                $student->marital_status = $data['marital_status'];
                $student->gendar = $data['gendar'];
                $student->language = $data['language'];
                $student->age = $data['age'];
                $student->marital_status = $data['marital_status'];
                $student->save();
      });
      return $student;
        //@todo we fire other actions after registration
    }

    /**
     * Create a admin account.
     */
    
}