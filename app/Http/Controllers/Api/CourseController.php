<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list()
    {
        $course = Course::orderBy('created_at', 'desc')->get();
        $data = CourseResource::collection($course);

        return response()->json(
            [
                'message' => 'Get Course Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
