<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\School;
use App\Models\Student;

class TokenService
{

    /**
     * Create a token for a user.
     */

     public function createTokenAdmin(Admin $admin, string $device_name, string $ip = Null, string $user_agent = Null): string
     {
         $token = $admin->createToken($device_name)->plainTextToken;
 
         return $token;
     }
    public function createTokenSchool(School $school, string $device_name, string $ip = Null, string $user_agent = Null): string
    {
        $token = $school->createToken($device_name)->plainTextToken;

        return $token;
    }

    public function createTokenStudent(Student $student, string $device_name, string $ip = Null, string $user_agent = Null): string
    {
        $token = $student->createToken($device_name)->plainTextToken;

        return $token;
    }
    /**
     * Revoke current access token for a user.
     */
    public function revokeCurrentTokenAdmin(Admin $admin)
    {
        return $admin->tokens()->where('id', optional($admin->currentAccessToken())->id)->delete();
    }
    public function revokeCurrentTokenSchool(School $school)
    {
        return $school->tokens()->where('id', optional($school->currentAccessToken())->id)->delete();
    }

    public function revokeCurrentTokenStudent(Student $student)
    {
        return $student->tokens()->where('id', optional($student->currentAccessToken())->id)->delete();
    }
}