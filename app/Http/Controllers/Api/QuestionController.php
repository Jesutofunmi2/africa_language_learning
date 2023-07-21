<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuestionRequest;
use App\Http\Resources\OptionResource;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
    public function list(QuestionRequest $questionRequest)
    {
        $language_id = $questionRequest->language_id;
        $topic_id = $questionRequest->topic_id;
       
        $question = Question::query()->orderBy('created_at', 'asc')->where('status', true)->where('topic_id', $topic_id)->whereRelation('options', 'language_id', '=', $language_id)->get();
        
        $data = QuestionResource::collection($question);

        return response()->json(
            [
                'message' => 'Get Question Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
