<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\TokenService;
use Illuminate\Http\JsonResponse;

class SchoolLogoutController extends Controller
{
    //
    public function __construct(protected TokenService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $this->service->revokeCurrentToken($request->school());

        return response()->json([
            'message' => 'Token deleted successfully.',
            'data' => null
        ]);
    }
}
