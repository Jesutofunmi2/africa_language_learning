<?php

namespace App\Services;

use App\Jobs\SendSchoolVerificationMail;
use App\Models\School;
use App\Models\SecondarySchool;
use App\Models\Teacher;
use Facade\FlareClient\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TeacherService
{

    public function createTeacher(array $data): Teacher
    {
        $teacher = new Teacher;
        $password = '12345678';

        DB::transaction(function () use (&$teacher, $data, $password) {
            $mediaService = new MediaService;
            $mediaUrl = $mediaService->uploadImage($data['image_url']);

            $teacher->name = $data['name'];
            $teacher->school_id = $data['school_id'];
            $teacher->email = $data['email'];
            $teacher->password = Hash::make($password);
            $teacher->image_url = $mediaUrl ?? null;
            $teacher->address = $data['address'];
            $teacher->save();

            dispatch(new SendSchoolVerificationMail($teacher->name, $teacher->email, $teacher->verification_token));

            $teacher_id = $this->teacherId($teacher->name, $teacher->id);
            $teacher->teacher_id = $teacher_id;
            $teacher->save();

            //@todo we fire other actions after registration
        });

        return $teacher;
    }

    protected function teacherId($name, $id)
    {
        $letter = mb_substr($name, 0, 3);
        $date = Carbon::now()->format('Y');
        $id = str_pad($id, 5, "0", STR_PAD_LEFT);
        $teacher_id = $letter . '/' . $date . '/' . 'IZESAN' . '/' . $id;

        return $teacher_id;
    }

    public function showTeacher($id):Teacher
    {
        $teacher = Teacher::whereId($id)->first();

        return $teacher;
    }

    public function updateTeacher(array $data, $image = null, $teacherId):Teacher
    {
        $url = null;
        $mediaService = new MediaService;
        if (!is_null($image)) {
            $url = $mediaService->uploadImage($data['image_url']);
        }
        
        $teacher = Teacher::whereId($teacherId)->first();
    
        
        if($url == null){
            $url = $teacher->image_url;
        }

        $new_teacher = new Teacher;
        // if user id in array, we create new edition for the user

        $new_teacher::where('id', $teacherId)
            ->update([
                'teacher_id' => $data['teacher_id'] ?? $teacher->teacher_id,
                'name' => $data['name'] ?? $teacher->name,
                'email' => $data['email'] ?? $teacher->email,
                'school_id' => $data['school_id'] ?? $teacher->school_id,
                'address' => $data['address'] ?? $teacher->address,
                'image_url' => $url
            ]);

        return $new_teacher;
    }

    public function deleteTeacher($id):void
    {
        Teacher::whereId($id)->delete();
    }
}