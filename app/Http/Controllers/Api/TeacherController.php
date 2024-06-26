<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassArmStudentsRequest;
use App\Http\Requests\Api\SchoolRequest;
use App\Http\Requests\Api\TeacherGetRequest;
use App\Http\Requests\Api\TeacherRequest;
use App\Http\Resources\Api\ClassArmStudentsResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Models\Student;
use App\Models\StudentClassArm;
use App\Models\Teacher;
use App\Models\TeacherClassArm;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function __construct(protected TeacherService $teacherService)
    {
    }
    public function createTeacher(TeacherRequest $teacherrequest): JsonResponse
    {
        $teacher = $this->teacherService->updateTeacher($teacherrequest->validated(), $teacherrequest->teacher_id);
        abort_if(is_null($teacher), 204, 'Invalid Content or Parameter');
        // $data = TeacherResource::make($teacher);
        return response()->json(
            [
                'message' => 'Update successful.',
                // 'data' => $data,
            ],
            status: 201
        );
    }

    public function getTeacher(TeacherGetRequest $teacherRequest): JsonResponse
    {
        $teacher_id = $teacherRequest->teacher_id;
        $teacher = Teacher::query()->where('teacher_id', $teacher_id)->get();
        $data = TeacherResource::collection($teacher);

        return response()->json(
            [
                'message' => 'Get Teacher Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function list(SchoolRequest $schoolRequest): JsonResponse
    {
        $school_id = $schoolRequest->school_id;
        $teachers = Teacher::query()->orderBy('created_at', 'desc')->where('school_id', $school_id)->get();
        abort_if(is_null($teachers), 204, 'No Content');
        $data = TeacherResource::collection($teachers);

        return response()->json(
            [
                'message' => 'Get Teacher Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function classarmStudent(ClassArmStudentsRequest $classArmStudentsRequest): JsonResponse
    {
        $teacher_id = $classArmStudentsRequest->teacher_id;
        $class_id = $classArmStudentsRequest->class_id;

        $teacherClassInfo = TeacherClassArm::query()->where('id', $class_id)->where('teacher_id', $teacher_id)->select('classarms_id');


        $studentClassarm = StudentClassArm::query()->wherein('classarms_id', $teacherClassInfo)->select('student_id');

        $student = Student::query()->wherein('student_id', $studentClassarm)->get();

        $data = ClassArmStudentsResource::collection($student);
        return response()->json(
            [
                'message' => 'Get ClassArm Students Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function addTeacher(TeacherRequest $teacherRequest): JsonResponse
    {
        $teacher = $this->teacherService->createTeacher($teacherRequest->validated());
        abort_if(is_null($teacher), 204, 'Invalid Content');
        // $data = TeacherResource::make($teacher);
        return response()->json(
            [
                'message' => 'Registration successful.',
                // 'data' => $data,
            ],
            status: 201
        );
    }

    public function updateTeacher(TeacherRequest $teacherrequest, TeacherGetRequest $teacherGetRequest): JsonResponse
    {
        $teacher_id = $teacherGetRequest->teacher_id;
        $teacher = $this->teacherService->updateTeacher($teacherrequest->validated(), $teacher_id,);
        abort_if(is_null($teacher), 204, 'Invalid Content');
        return response()->json(
            [
                'message' => 'Teacher Updated Successful.',
                //'data' => $data
            ],
            status: 200
        );
    }

    public function destroy(TeacherGetRequest $teachergetRequest)
    {
        $teacher_id = $teachergetRequest->teacher_id;
        abort_if(is_null($teacher_id), 204, 'Invalid Content');
        $this->teacherService->deleteTeacher($teacher_id);
        return response()->json(
            [
                'message' => 'Student Deleted Successful.',
                //'data' => $data
            ],
            status: 200
        );
    }
}
