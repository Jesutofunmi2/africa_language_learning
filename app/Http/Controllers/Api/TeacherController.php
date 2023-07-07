<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SchoolRequest;
use App\Http\Requests\Api\TeacherGetRequest;
use App\Http\Requests\Api\TeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    
    public function __construct(protected TeacherService $teacherService)
    {
       // $this->middleware('auth');
    }
 

    public function createTeacher(TeacherRequest $request): JsonResponse
    {
        dd($request);
        $teacher = $this->teacherService->createTeacher($request->validated());

        $data = TeacherResource::make($teacher);


        return response()->json(
            [
                'message' => 'Registration successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function getTeacher(TeacherGetRequest $teacherRequest):JsonResponse
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


    public function list(SchoolRequest $schoolRequest):JsonResponse
    {
        $school_id = $schoolRequest->school_id;

        $teachers = Teacher::query()->where('school_id', $school_id)->get();
        $data = TeacherResource::collection($teachers);

        return response()->json(
            [
                'message' => 'Get Teacher Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function addTeacher(TeacherRequest $teacherRequest):JsonResponse
    {
        $teacher = $this->teacherService->createTeacher($teacherRequest->validated());

        $data = TeacherResource::make($teacher);


        return response()->json(
            [
                'message' => 'Registration successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function updateTeacher(TeacherRequest $request):JsonResponse
    {
        dd($request->validated());
        $image = $request->image_url;
        $teacher_id = $request->teacher_id;
        $teacher = $this->teacherService->updateTeacher( $request->validated(),$image, $teacher_id, );
        //$data = StudentResource::make($student);

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
