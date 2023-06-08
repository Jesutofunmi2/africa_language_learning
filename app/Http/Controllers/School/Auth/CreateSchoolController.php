<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Resources\LoginResource;
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

        $token = $this->tokenService->createTokenSchool($school, $userData['device_name'] ?? 'test', $ip, $user_agent);

        return response()->json([
            'message' => 'Registration successful.',
            'data' => LoginResource::make($school->withAccessToken($token))],
            status: 201
        );
    }
}
