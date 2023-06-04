<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a user account.
     */
    public function createUser(array $data): User
    {
        $user = new User;

        DB::transaction(function() use (&$user, $data) {

            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            //@todo we fire other actions after registration
        });

        return $user;
    }

    /**
     * Create a admin account.
     */
    public function createAdnin(array $data): User
    {
        $user = new User;

        DB::transaction(function() use (&$user, $data) {

            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->is_admin = true;
            $user->password = Hash::make($data['password']);
            $user->save();

            //@todo we fire other actions after registration
        });

        return $user;
    }
}