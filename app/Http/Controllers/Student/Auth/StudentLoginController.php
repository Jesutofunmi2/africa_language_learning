<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StudentLoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\TokenService;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{
    //
    
    public function __construct(protected TokenService $service) {}

   
    public function __invoke(StudentLoginRequest $request): JsonResponse
    {
        
        $student = $this->authenticateUser($request);

        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $token = $this->service->createTokenStudent(
            $student,
            $data['device_name'] ?? 'test_device',
            $ip,
            $user_agent
        );

        return response()->json([
            'message' => 'Login Successful',
            'data' => LoginResource::make($student->withAccessToken($token))
        ]);
        
    }

   
    protected function authenticateUser(StudentLoginRequest $request): Student
    {
        $data = $request->validated();

        $student = Student::where('email', $data['email'])->first();

        abort_if(is_null($student), 401, 'Incorrect login details');

        if(! Hash::check($data['password'], $student->password)) {
            abort(401, 'Incorrect login details');
        }

        return $student;
    }
}

