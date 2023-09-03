<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Teacher\TeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Services\TeacherService;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTeacherController extends Controller
{
    //
    
    public function __construct(protected TokenService $tokenService, protected TeacherService $teacherService)
    {
        dd('jjj');
    }

    public function __invoke(TeacherRequest $request): JsonResponse
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
}
