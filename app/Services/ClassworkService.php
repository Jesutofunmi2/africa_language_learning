<?php

namespace App\Services;

use App\Models\ClassWork;
use Illuminate\Support\Facades\DB;

class ClassWorkService
{
    public function createClasswork(array $data): ClassWork
    {
        DB::transaction(function () use (&$classwork, $data) {
            $classwork = new ClassWork;
            $mediaService = new MediaService;
            if ($data['media_url'] != null) {
                $mediaUrl = $mediaService->uploadImage($data['media_url']);
            }

            $classwork->name = $data['name'];
            $classwork->school_id = $data['school_id'];
            $classwork->teacher_id = $data['teacher_id'];
            $classwork->class_id = $data['class_id'];
            $classwork->media_url = $mediaUrl;

            $classwork->save();
        });

        return $classwork;
    }

    public function showClassWork(array $data): ClassWork
    {
       
        $classwork = ClassWork::where('teacher_id',$data['teacher_id'])
                            ->where('school_id', $data['school_id'])
                            ->where('class_id', $data['class_id'])
                            ->get();

        return $classwork;
     
    }

    public function deleteClassWork(array $data)
    {
        $deleteClassWork = ClassWork::where('teacher_id', $data['teacher_id'])
                               ->where('school_id', $data['school_id'])
                               ->where('class_id', $data['class_id'])
                               ->where('name', $data['name'] )->delete();

       return $deleteClassWork;
    }
}
