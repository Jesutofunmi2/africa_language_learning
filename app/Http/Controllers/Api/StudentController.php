<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SchoolRequest;
use App\Http\Requests\Api\StudentRequest;
use App\Http\Requests\School\SecondaryRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    // Get student by school Id
    public function list(SchoolRequest $schoolRequest)
    {
        $school_id = $schoolRequest->school_id;
        
        $student = Student::query()->where('school_id', $school_id)->get();
        $data = StudentResource::collection($student);

        return response()->json(
            [
                'message' => 'Get Student Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function create(SecondaryRequest $secondaryRequest)
    {
       
    }
}
