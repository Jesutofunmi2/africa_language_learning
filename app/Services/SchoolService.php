<?php

namespace App\Services;

use App\Jobs\SendSchoolVerificationMail;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolService
{
    /**
     * Create a school account.
     */
    public function createSchool(array $data): School
    {
        $school = new School;

        DB::transaction(function() use (&$school, $data) {

            $school->name = $data['name'];
            $school->country = $data['country'];
            $school->email = $data['email'];
            $school->password = Hash::make($data['password']);
            $school->type = $data['type'];
            $school->school_name = $data['school_name'];
            $school->phone_number = $data['phone_number'];
            $school->no_of_pupil = $data['no_of_pupil'];
            $school->image_url = $data['image_url'];
            $school->verification_token = md5($data['email']).Str::random();
            $school->save();

            dispatch(new SendSchoolVerificationMail($school->name, $school->email, $school->verification_token));

            //@todo we fire other actions after registration
        });
        
        return $school;
    }

    /**
     * Create a admin account.
     */
    
}