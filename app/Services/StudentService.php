<?php

namespace App\Services;

use App\Http\Requests\Api\CreateBatchStudent;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentClassArm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Imports\StudentsImport;


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
                $student->gendar = $data['gender'];
                $student->language = $data['language'];
                $student->age = $data['age']?? null;
            
                $student->save();

                $prefix = $this->getStudentPrefix($data['school_id']);
                $student->student_id = $prefix.$student->id;
                $student->save();

                $studentClassArm->student_id = $student->student_id;
                $studentClassArm->classes_id = $data['class_id'];
                $studentClassArm->classarms_id = $data['classarm_id'];
                $studentClassArm->term = $data['term'];
                $studentClassArm->session = $data['session'];
                $studentClassArm->save();
      });
      return $student;
        //@todo we fire other actions after registration
    }


    public function createBatchStudent(array $data, CreateBatchStudent $createBatchStudent)
    {

        
       
        $session = $data['session'];
        $term = $data['term'];
        $class_id = $data['class_id'];
        $school_id = $data['school_id'];
        $classarm_id = $data['class_arm_id'];

  

        if ($createBatchStudent->hasFile('batch_file')) {

            $prefix = $this->getStudentPrefix($data['school_id']);
            

            $data = [
                'session' => $session,
                'term' => $term,
                'class_id' => $class_id,
                'class_arm_id' => $classarm_id,
                'prefix' => $prefix,
                'school_id' => $school_id,
                
            ];
  
            $import = new StudentsImport($data);
            $import->import($createBatchStudent->file('batch_file'));

    

            $failures[] = [];
            $row = 0;
            foreach ($import->failures() as $failure) {
                $failures[$row]['row'] = $failure->row(); // row that went wrong
                $failures[$row]['attrib'] = $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failures[$row]['errors'] = $failure->errors(); // Actual error messages from Laravel validator
                $row++;
           }

            $errors = $import->errors();

            return response()->json([
                'data' => [
                    'message' => 'Batch Student Registration complete',
                    'failures' => $failures,
                    'errors' => $errors,
                ]
            ]);

        }
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

    protected function getStudentPrefix($schId)
    {
        $name = School::query()->whereId($schId)->first();
        $letter = mb_substr($name->name, 0, 3);
        $date = Carbon::now()->format('Y');
        // $id = str_pad($id, 4, "0", STR_PAD_LEFT);
        return Str::upper($letter).'/'.$date;
    }
    /**
     * Create a admin account.
     */
    
     public function getNextRegNum( $school_id = 0){

        if($school_id == 0){ 
            abort(400, "school ID not found, please contact admin");
        }
        
        $school = $school_id;

        $regnum_digit = Student::where('school_id', $school)
                        ->withTrashed()
                        ->orderBy('id', 'desc')->first();
                        
        if(!empty($regnum_digit)){
            return $regnum_digit + 1;
        }else{
            return 1;
        }

    }

}