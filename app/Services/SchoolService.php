<?php

namespace App\Services;

use App\Jobs\SendSchoolVerificationMail;
use App\Models\School;
use App\Models\SecondarySchool;
use Facade\FlareClient\View;
use Illuminate\Support\Carbon;
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
      
        DB::transaction(function () use (&$school, $data) {
            $school = new School;
            $mediaService = new MediaService;
            $defaultImage = "https://course-material-dev.s3.us-east-2.amazonaws.com/logoi.png";
            if(in_array('image_url', $data))
            {
                $mediaUrl = $mediaService->uploadImage($data['image_url']);
            }
            else {
                $mediaUrl = $defaultImage;
            }

            $school->name = $data['name'];
            $school->country = $data['country'];
            $school->email = $data['email'];
            $school->password = Hash::make($data['password']);
            $school->type = $data['type'];
            $school->school_name = $data['school_name'];
            $school->phone_number = $data['phone_number'];
            $school->no_of_pupil = $data['no_of_pupil'];
            $school->image_url = $mediaUrl ;
            $school->verification_token = md5($data['email']) . Str::random();
            $school->trial_days = $data['trial_period_in_days'] ;
            $school->lga = $data['lga'];
            $school->save();

            dispatch(new SendSchoolVerificationMail($school->name, $school->email, $school->verification_token));

            //@todo we fire other actions after registration
        });

        return $school;
    }

    /**
     * Create a admin account.
     */


    public function createSecondarySchool(array $data): SecondarySchool
    {
        $school = new SecondarySchool;
        $password = '12345678';

        DB::transaction(function () use (&$school, $data, $password) {
            $mediaService = new MediaService;
            $mediaUrl = $mediaService->uploadImage($data['image_url']);

            $school->name = $data['name'];
            $school->state = $data['state'];
            $school->email = $data['email'];
            $school->password = Hash::make($password);
            $school->type = $data['type'];
            $school->lga = $data['lga'];
            $school->image_url = $mediaUrl;
            $school->address = $data['address'];
            $school->save();

            dispatch(new SendSchoolVerificationMail($school->name, $school->email, $school->verification_token));

            $school_id = $this->schoolId($school->name, $school->id);
            $school->school_id = $school_id;
            $school->save();

            //@todo we fire other actions after registration
        });

        return $school;
    }

    public function showSchool($schoolId): School
    {
        $school = School::whereId($schoolId)->first();

        return $school;
    }


    public function update(School $secondary, array $data, $image = null, $schoolId): School
    {
        $url = null;
       
        if (!is_null($image)) {
            $mediaService = new MediaService;
            $url = $mediaService->uploadImage($image);
        }
        
        $school = School::where('id', $schoolId)->first();
        // if user id in array, we create new edition for the user
        $new_school = School::where('id', $schoolId)
            ->update([
                'name' => $data['name']?? $school->name,
                'school_name' => $data['school_name'] ?? $school->school_name,
                'email' => $data['email'] ?? $school->email,
                'state' => $data['state'] ?? $school->state,
                'lga' => $data['lga'] ?? $school->lga,
                'phone_number' => $data['phone_number'] ?? $school->phone_number,
                'country' => $data['country'] ?? $school->country,
                'type' => $data['type'] ?? $school->type,
                'no_of_pupil' => $data['no_of_pupil']?? $school->no_of_pupil,
                'image_url' => $url ?? $school->image_url,
                'trial_days' => $data['trial_period_in_days'],
            ]);

        return $secondary;
    }

    public function list()
    {
        $users = SecondarySchool::orderBy('created_at', 'desc')->paginate(15);
        return $users;
    }

    public function schoolStatus($id)
    {
        $new_school = new School;
        $school = School::whereId($id)->first();
        if ($school->status == true) {
            $new_school::whereId($id)->update([
                'status' => false
            ]);
        } else {
            $new_school::whereId($id)->update([
                'status' => true
            ]);
        }

        return $new_school;
    }


    public function deleteSchool($schoolId): void
    {
        School::whereId($schoolId)->delete();
    }

    protected function schoolId($name, $id)
    {
        $letter = mb_substr($name, 0, 3);
        $date = Carbon::now()->format('Y');
        $id = str_pad($id, 5, "0", STR_PAD_LEFT);
        $school_id = $letter . '/' . $date . '/' . 'IZESAN' . '/' . $id;

        return $school_id;
    }
}
