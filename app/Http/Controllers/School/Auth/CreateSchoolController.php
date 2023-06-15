<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SchoolResource;
use App\Services\TokenService;
use App\Services\SchoolService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateSchoolController extends Controller
{
      public function __construct(protected TokenService $tokenService, protected SchoolService $schoolService) {}

    public function __invoke(CreateSchoolRequest $request): JsonResponse
    {
        $school = $this->schoolService->createSchool($request->validated());
       
        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $data = SchoolResource::make($school);

        $token = $this->tokenService->createTokenSchool($school, 'test', $ip, $user_agent);

        return response()->json([
            'message' => 'Registration successful.',
            'data' =>  $data,
            'token' => LoginResource::make($school->withAccessToken($token))],
            status: 201
        );
    }
}
