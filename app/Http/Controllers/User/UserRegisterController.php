<?php
 
namespace App\Http\Controllers\User;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\LoginResource;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UserRegisterController extends Controller
{

    public function __construct(protected TokenService $tokenService, protected UserService $userService) {}

    /**
     * Register User Endpoint.
     * 
     * This endpoint handles user registration.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @group Auth
     * 
     * @bodyParam firstname string required The first name of the user.
     * @bodyParam firstname string required The last name of the user.
     * @bodyParam email string required The email of the of the user.
     * @bodyParam password string required The user's account password
     * @bodyParam device_name string
     */
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
       
        $ip = $request->ip();
        $user_agent = $request->userAgent();

        $token = $this->tokenService->createTokenAdmin($user, $userData['device_name'] ?? 'test', $ip, $user_agent);

        return response()->json([
            'message' => 'Registration successful.',
            'data' => LoginResource::make($user->withAccessToken($token))],
            status: 201
        );
    }
}