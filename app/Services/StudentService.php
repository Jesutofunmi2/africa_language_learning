<?php

namespace App\Services;

use App\Models\School;
use App\Models\Student;
use App\Models\StudentClassArm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentService
{
    /**
     * Create a school account.
     */
    public function createStudent(array $data): Student
    {
        $student = new Student;
        $studentClassArm = new StudentClassArm;
        $date = date("Y");
        $session = $date. '/'. $date+1;

        $phone_number = '08139525526';
        $password = '12345678';
        $data['password'] = $password;
            DB::transaction(function() use (&$student, $data, $phone_number, $password, $studentClassArm, $session) {
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

                $student_id = $this->studentId($student->school_id, $student->id);
                $student->student_id = $student_id;
                $student->save();

                $studentClassArm->student_id = $student_id;
                $studentClassArm->classes_id = $data['class_id'];
                $studentClassArm->classarms_id = $data['classarm_id'];
                $studentClassArm->term = $data['term'];
                $studentClassArm->session = $data['session'];
                $studentClassArm->save();
      });
      return $student;
        //@todo we fire other actions after registration
    }

    public function assignStudentToClass(array $data)
    {
       
    
        $classId =   $data['class_id'];
        $classarmId = $data['classarm_id'];
        $term = $data['term'];
        $session = $data['session'];

        $studentDatas = collect($data['data'])->map(function ($studentData) use ($session, $classId, $classarmId, $term) {
            $studentClassArm = new StudentClassArm;
                $studentClassArm->student_id = $studentData['student_id'];
                $studentClassArm->classes_id = $classId;
                $studentClassArm->classarms_id = $classarmId;
                $studentClassArm->session = $session;
                $studentClassArm->term = $term;
                $studentClassArm->save();
      });
      
    }
    public function updateStudent($id, $data):Student
    {
        
        $new_student = new Student;
        $student = Student::where('student_id' ,$id)->first();
        $new_student::where('student_id', $id)
        ->update([
            'first_name' => $data['first_name'] ?? $student->first_name,
            'last_name' => $data['last_name'] ?? $student->last_name,
            'language' => $data['language'] ?? $student->language,
            'country' => $data['country'] ?? $student->country,
            'age' => $data['age'] ?? $student->age,
            'gendar' => $data['gendar'] ?? $student->gendar,
        ]);

    return $new_student;
    }
    

    public function deleteStudent($id):void
    {
       Student::where('student_id' ,$id)->delete();
    }

    protected function studentId($schId, $id)
    {
        $name = School::query()->whereId($schId)->first();
        $letter = mb_substr($name->name, 0, 3);
        $date = Carbon::now()->format('Y');
        $id = str_pad($id, 2, "0", STR_PAD_LEFT);
        $student_id = Str::upper($letter).'/'.$date.$id;

        return $student_id;
    }
    /**
     * Create a admin account.
     */
    
}