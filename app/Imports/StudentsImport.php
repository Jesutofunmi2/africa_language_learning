<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements OnEachRow, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError, WithStartRow
{
    use Importable, SkipsFailures, SkipsErrors;

    protected $data;
    protected $startRow = 2; 
    protected $prefix;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->prefix = $data['prefix'];
    }


    public function onRow(Row $row)
    {
        $student = new Student;
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        $phone_number = '08139525526';
        $password = '12345678';
        $email = 'sunday@izesan.com';
        $marital_status = 'single';
        $country = 'nigeria';
        
        $exist = Student::query()->join('student_class_arms', 'students.student_id' , '=','student_class_arms.student_id')
        ->where([
                'students.first_name' => $row['first_name'],
                'students.last_name' => $row['last_name'],
                'student_class_arms.session' => $this->data['session'],
                'student_class_arms.classes_id' => $this->data['class_id'],
                'student_class_arms.classarms_id' => $this->data['class_arm_id']
        ])
        ->exists();
    
        if ($exist) {
            return null;
        }
        DB::transaction(function() use (&$student, $phone_number, $password, $row, $country, $email, $marital_status) {

                $student->first_name = $row['first_name'];
                $student->last_name = $row['last_name'];
                $student->school_id = $this->data['school_id'];
                $student->email = null ;
                $student->phone_number = $phone_number;
                $student->password = Hash::make($password); 
                $student->country = $country;
                $student->marital_status = $marital_status ;
                $student->gendar = $row['gender'];
                $student->language = $row['language'];
                $student->age = $row['age'];
            
                $student->save();

    
       
        $student->student_id = $this->prefix . $student->id;
        $student->save();


        if ($student) {
            DB::table('student_class_arms')->insert([
                'student_id' => $student->student_id,
                'classarms_id' => $this->data['class_arm_id'],
                'session' => $this->data['session'],
                'term' => $this->data['term'],
                'classes_id' => $this->data['class_id'],
            ]);
        }

    });

}



    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'language' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ];
    }


    public function startRow(): int
    {
        return $this->startRow;
    }
}
