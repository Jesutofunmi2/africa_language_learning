<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
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
                'message' => 'Get Topic Successful.',
                'data' => $data
            ],
            status: 200
        );
    }


    public function type(TopicRequest $topicRequest)
    {
        $type= $topicRequest->type;
        $topics = Topic::query()->orderBy('created_at', 'asc')->where('type', $type)->get();
        $data = TopicResource::collection($topics);

        return response()->json(
            [
                'message' => 'Get Topic Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
