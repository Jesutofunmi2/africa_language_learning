<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AssignStudentToClass;
use App\Http\Requests\Api\CreateBatchStudent;
use App\Http\Requests\Api\SchoolRequest;
use App\Http\Requests\Api\StudentRequest;
use App\Http\Requests\School\SecondaryRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{

    public function __construct(protected StudentService $studentService)
    {
        // $this->middleware('auth');

    }

    // Get student by school Id
    public function list(SchoolRequest $schoolRequest)
    {
        $school_id = $schoolRequest->school_id;

        $students = Student::query()->orderBy('created_at', 'desc')->where('school_id', $school_id)->get();
        $data = StudentResource::collection($students);

        return response()->json(
            [
                'message' => 'Get Student Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function getStudent(StudentRequest $studentRequest)
    {
        $student_id = $studentRequest->student_id;

        $student = Student::query()->where('student_id', $student_id)->get();
        $data = StudentResource::collection($student);

        return response()->json(
            [
                'message' => 'Get Student Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function update(StudentRequest $studentRequest)
    {
        $student_id = $studentRequest->student_id;
        $this->studentService->updateStudent($student_id, $studentRequest->validated());
        return response()->json(
            [
                'message' => 'Student Updated Successful.',
            ],
            status: 200
        );
    }

    public function createBatchStudent(CreateBatchStudent $createBatchStudent)
    {
        return $this->studentService->createBatchStudent($createBatchStudent->validated(), $createBatchStudent);
    }

    public function assignStudentToClass(AssignStudentToClass $assignStudentToClass)
    {
        $this->studentService->assignStudentToClass($assignStudentToClass->validated());
        return response()->json(
            [
                'message' => 'Student Class Updated Successful.',
            ],
            status: 200
        );
    }

    public function studentsPdfDownload(SchoolRequest $schoolRequest)
    {
        $school_id = $schoolRequest->school_id;
        $url = null;

        $students = Student::where('school_id', $school_id)->select('first_name', 'last_name', 'student_id', 'gendar')->get()->toArray();
        $schools = School::where('id', $school_id)->select('school_name', 'image_url', 'lga', 'email')->get()->toArray();

        $pdf = PDF::loadView('pages.admin.students-pdf', compact('students', 'schools'));

        $file_path = 'downloads/' . Str::random(15) . '.' . 'pdf';

        $url = Storage::put($file_path,  $pdf->output());
        $url = Storage::url($file_path);

        return $url;
    }


    public function destroy(StudentRequest $studentRequest)
    {
        $student_id = $studentRequest->student_id;
        $this->studentService->deleteStudent($student_id);

        return response()->json(
            [
                'message' => 'Student Deleted Successful.',
            ],
            status: 200
        );
    }
}
