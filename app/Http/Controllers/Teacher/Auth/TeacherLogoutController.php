<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeacherLogoutController extends Controller
{
    public function __construct(protected \App\Services\TokenService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $this->service->revokeCurrentTokenSchool($request->teacher());

        return response()->json([
            'message' => 'Token deleted successfully.',
            'data' => null
        ]);
    }
}
