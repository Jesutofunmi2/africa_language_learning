<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\StudentResource;
use App\Services\TokenService;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateStudentController extends Controller
{
    //
    public function __construct(protected TokenService $tokenService, protected StudentService $studentService)
    {
    }

    public function __invoke(CreateStudentRequest $request): JsonResponse
    {
        dd($request);
        $student = $this->studentService->createStudent($request->validated());

        //$ip = $request->ip();
       // $user_agent = $request->userAgent();
        $data = StudentResource::make($student);

       // $token = $this->tokenService->createTokenStudent($student, 'test', $ip, $user_agent);

        return response()->json(
            [
                'message' => 'Registration successful.',
                'data' => $data,
            ],
            status: 201
        );
    }
}
