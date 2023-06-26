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
        $school = new School;

        DB::transaction(function () use (&$school, $data) {

            $school->name = $data['name'];
            $school->country = $data['country'];
            $school->email = $data['email'];
            $school->password = Hash::make($data['password']);
            $school->type = $data['type'];
            $school->school_name = $data['school_name'];
            $school->phone_number = $data['phone_number'];
            $school->no_of_pupil = $data['no_of_pupil'];
            $school->image_url = $data['image_url'];
            $school->verification_token = md5($data['email']) . Str::random();
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

    public function showSchool($schoolId): SecondarySchool
    {
        $school = SecondarySchool::whereId($schoolId)->first();

        return $school;
    }

    public function update(SecondarySchool $secondary, array $data, $image = null, $schoolId): SecondarySchool
    {
        $url = null;

        if (!is_null($image)) {
            $mediaService = new MediaService;
            $url = $mediaService->uploadImage($data['image_url']);
        }

        // if user id in array, we create new edition for the user
        $new_school = SecondarySchool::where('id', $schoolId)
            ->update([
                'name' => $data['name'],
                'address' => $data['address'],
                'email' => $data['email'],
                'state' => $data['state'],
                'lga' => $data['lga'],
                'type' => $data['type'],
                'image_url' => $url ?? $secondary->image_url
            ]);

        return $secondary;
    }

    public function deleteSchool($schoolId): void
    {
        SecondarySchool::whereId($schoolId)->delete();
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
