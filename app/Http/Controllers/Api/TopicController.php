<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function list()
    {
        $lesson = Topic::orderBy('created_at', 'desc')->get();
        $data = TopicResource::collection($lesson);

        return response()->json(
            [
                'message' => 'Get Lesson Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
