<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StudentLoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\StudentResource;
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
        $data = StudentResource::make($student);

        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $token = $this->service->createTokenStudent(
            $student,
            'test_device',
            $ip,
            $user_agent
        );

        return response()->json([
            'message' => 'Login Successful',
            'data' => $data,
            'token' => LoginResource::make($student->withAccessToken($token))
        ]);
        
    }

   
    protected function authenticateUser(StudentLoginRequest $request): Student
    {
        $data = $request->validated();

        if (!filter_var($data['login_id'], FILTER_VALIDATE_EMAIL)) {

            $student = Student::where('student_id', $data['login_id'])->first();
            abort_if(is_null($student), 401, 'Incorrect login details');

            if(! Hash::check($data['password'], $student->password)) {
                abort(401, 'Incorrect login details');
            }
          }else{
            $student = Student::where('email', $data['login_id'])->first();
            abort_if(is_null($student), 401, 'Incorrect login details');

            if(! Hash::check($data['password'], $student->password)) {
                abort(401, 'Incorrect login details');
            }
          }
       
        return $student;
    }
}

