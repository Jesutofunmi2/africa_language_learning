<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;


class CourseService
{
    public function createCourse(array $data):Course
    {
        $course = new Course;
        $mediaService = new MediaService;
        $mediaUrl = $mediaService->uploadImage($data['image_url']);

        DB::transaction(function () use (&$course , $data, $mediaUrl) {
            $course->title = $data['title'];
            $course->description = $data['description'];
            $course->image_url = $mediaUrl;
            $course->save();
        });
     return $course;
    }

    public function showCourse($courseId): Course
    {
        $course = Course::whereId($courseId)->first();

        return $course;
    }


    public function updateCourse(array $data,  $courseId): Course
    {
        $courses = Course::whereId($courseId)->first();
       
        $course = new Course;
        // if user id in array, we create new edition for the user
        $course::where('id', $courseId)
            ->update([
                'title' => $data['title']?? $courses->title,
                'description' => $data['description']?? $courses->description,
                'image_url' => $data['image_url'] ?? $courses->image_url
            ]);

        return $course ;
    }


    public function deleteCourse($courseId): void
    {
        Course::where('id',$courseId)->delete();
    }

}