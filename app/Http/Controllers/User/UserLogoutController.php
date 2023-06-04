<?php
 
namespace App\Http\Controllers\User;

use App\Http\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UserLogoutController extends Controller
{

    public function __construct(protected TokenService $service) {}

   /**
     * Logout token
     *
     * This endpoint handles logging a user out
     * of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @response {
     *      "message": "Token deleted successfully.",
     *      "data": null,
     * }
     *
     * @authenticated
     * @group Auth
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->service->revokeCurrentToken($request->user());

        return response()->json([
            'message' => 'Token deleted successfully.',
            'data' => null
        ]);
    }
}