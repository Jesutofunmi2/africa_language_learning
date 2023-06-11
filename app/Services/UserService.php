<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a user account.
     */
    public function createUser(array $data): Admin
    {
        $user = new Admin;

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
    public function createAdmin(array $data): Admin
    {
        $user = new Admin;

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