<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Option;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function checkAnswer(AnswerRequest $answerRequest)
    {
        $question_id = $answerRequest->question_id;
        $option_id = $answerRequest->option_id;

        $option = Option::query()->where('option_id', $option_id)
            ->whereRelation('options', 'question_id', '=', $question_id)
            ->where('is_correct', true)->get();
        $data = AnswerResource::collection($option);
 
            dd($data);

        return response()->json(
            [
                'message' => 'Correct Answer.',
                'data' => true
            ],
            status: 200
        );
    }
}
