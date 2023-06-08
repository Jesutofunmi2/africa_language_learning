<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\School\SchoolLoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\TokenService;
use App\Models\School;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class SchoolLoginController extends Controller
{
    //
    public function __construct(protected TokenService $service) {}

    public function __invoke(SchoolLoginRequest $request): JsonResponse
    {
        
        $school = $this->authenticateUser($request);

        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $token = $this->service->createTokenSchool(
            $school,
            $data['device_name'] ?? 'test_device',
            $ip,
            $user_agent
        );

        return response()->json([
            'message' => 'Login Successful',
            'data' => LoginResource::make($school->withAccessToken($token))
        ]);
        
    }

   
    protected function authenticateUser(SchoolLoginRequest $request): School
    {
        $data = $request->validated();

        $school = School::where('email', $data['email'])->first();

        abort_if(is_null($school), 401, 'Incorrect login details');

        if(! Hash::check($data['password'], $school->password)) {
            abort(401, 'Incorrect login details');
        }

        return $school;
    }
}
