<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function list()
    {
        $lesson = Course::all();
        $data = LessonResource::collection($lesson);

        return response()->json(
            [
                'message' => 'Get Lesson Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
