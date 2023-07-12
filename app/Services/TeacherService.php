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
            $teacher->address = $data['address']?? null;
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

    public function showTeacher($id): Teacher
    {
        $teacher = Teacher::whereId($id)->first();

        return $teacher;
    }

    public function updateTeacher(array $data,  $teacherId): Teacher
    {
        $mediaUrl= null;
        $password = '12345678';
        if(!is_null($data['image_url'])){
            $mediaService = new MediaService;
            $mediaUrl = $mediaService->uploadImage($data['image_url']);
        }
      
        $teacher = Teacher::where('teacher_id', $teacherId)->first();

        $old_teacher = new Teacher;
        $new_teacher = new Teacher;
        // if user id in array, we create new edition for the user
        
        // delete if exists
       $old_teacher::where('teacher_id', $teacherId)->delete();
        $new_teacher->teacher_id = $teacherId ;
        $new_teacher->name = $data['name'] ?? $teacher->name;
        $new_teacher->school_id = $data['school_id'] ?? $teacher->school_id;
        $new_teacher->email = $teacher->email ?? $data['email'];
        $new_teacher->password = Hash::make($password);
        $new_teacher->image_url = $mediaUrl ?? $teacher->image_url;
        $new_teacher->address = $data['address']?? $teacher->address;
        $new_teacher->save();
        
        return $new_teacher;
    }

    public function deleteTeacher($id): void
    {
        Teacher::where('teacher_id',$id)->delete();
    }
}
