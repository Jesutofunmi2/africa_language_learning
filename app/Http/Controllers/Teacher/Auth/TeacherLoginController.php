<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherLoginRequest;
use App\Http\Resources\TeacherResource;
use Illuminate\Http\Request;
use App\Http\Requests\School\SchoolLoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SchoolResource;
use App\Services\TokenService;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class TeacherLoginController extends Controller
{
    public function __construct(protected TokenService $service)
    {
    }

    public function __invoke(TeacherLoginRequest $request): JsonResponse
    {
        $teacher = $this->authenticateUser($request);
        $data = TeacherResource::make($teacher);

        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $token = $this->service->createTokenTeacher(
            $teacher,
            'test_device',
            $ip,
            $user_agent
        );

        return response()->json([
            'message' => 'Login Successful',
            'data' => $data,
            'token' => LoginResource::make($teacher->withAccessToken($token))
        ]);
    }


    protected function authenticateUser(TeacherLoginRequest $request): Teacher
    {
        $data = $request->validated();

        $teacher = Teacher::where('teacher_id', $data['teacher_id'])->first();

        abort_if(is_null($teacher), 401, 'Incorrect login details');

        if (!Hash::check($data['password'], $teacher->password)) {
            abort(401, 'Incorrect login details');
        }

        return $teacher;
    }
}
