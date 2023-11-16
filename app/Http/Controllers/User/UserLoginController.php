<?php
 
namespace App\Http\Controllers\User;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\TokenService;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
 
class UserLoginController extends Controller
{

    public function __construct(protected TokenService $service) {}

    /**
     * Login Endpoint.
     * 
     * This endpoint handles an authentication attempt.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @group Auth
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        
        $user = $this->authenticateUser($request);

        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $token = $this->service->createTokenAdmin(
            $user,
            $data['device_name'] ?? 'test_device',
            $ip,
            $user_agent
        );

        return response()->json([
            'message' => 'Login Successful',
            'data' => LoginResource::make($user->withAccessToken($token))
        ]);
        
    }

    /**
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \App\Models\User
     */
    protected function authenticateUser(LoginRequest $request): Admin
    {
        $data = $request->validated();

        $user = Admin::where('email', $data['email'])->first();

        abort_if(is_null($user), 401, 'Incorrect login details');

        if(! Hash::check($data['password'], $user->password)) {
            abort(401, 'Incorrect login details');
        }

        return $user;
    }
}