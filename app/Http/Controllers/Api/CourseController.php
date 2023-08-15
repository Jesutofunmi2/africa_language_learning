<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\SingleCourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //Get all courses with the relation
    public function list(CourseRequest $courseRequest)
    {
        $id = $courseRequest->id;
        $course = Course::orderBy('created_at', 'asc')->where('id', $id)->get();
        $data = CourseResource::collection($course);

        return response()->json(
            [
                'message' => 'Get Course Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    //Get all courses without relation
    public function getCourse()
    {
        $course = Course::orderBy('created_at', 'desc')->get();
        $data = SingleCourseResource::collection($course);

        return response()->json(
            [
                'message' => 'Get Course Successful.',
                'data' => $data
            ],
            status: 200
        );
    }


}
