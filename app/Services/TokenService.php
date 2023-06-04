<?php

namespace App\Http\Services;

use App\Models\User;

class TokenService
{
    /**
     * Create a token for a user.
     */
    public function createToken(User $user, string $device_name, string $ip = Null, string $user_agent = Null): string
    {
        $token = $user->createToken($device_name)->plainTextToken;

        return $token;
    }

    /**
     * Revoke current access token for a user.
     */
    public function revokeCurrentToken(User $user)
    {
        return $user->tokens()->where('id', optional($user->currentAccessToken())->id)->delete();
    }
}