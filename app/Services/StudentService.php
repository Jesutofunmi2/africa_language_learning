<?php

namespace App\Services;

use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Carbon;
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
        $phone_number = '08139525526';
        $password = '12345678';
        $data['password'] = $password;
            DB::transaction(function() use (&$student, $data, $phone_number, $password) {
                $student->first_name = $data['first_name'];
                $student->last_name = $data['last_name'];
                $student->school_id = $data['school_id'] ?? null;
                $student->email = $data['email'] ?? null ;
                $student->phone_number = $phone_number;
                $student->password = Hash::make($password); 
                $student->country = $data['country'];
                $student->marital_status = $data['marital_status'] ?? null;
                $student->gendar = $data['gendar'];
                $student->language = $data['language'];
                $student->age = $data['age']?? null;
                $student->save();

                $student_id = $this->studentId( $student->id,);
                $student->student_id = $student_id;
                $student->save();
      });
      return $student;
        //@todo we fire other actions after registration
    }


    protected function studentId($id)
    {
    
        $date = Carbon::now()->format('Y');
        $id = str_pad($id, 2, "0", STR_PAD_LEFT);
        $student_id = $date.$id;

        return $student_id;
    }
    /**
     * Create a admin account.
     */
    
}