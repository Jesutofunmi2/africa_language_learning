<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function checkAnswer(AnswerRequest $answerRequest)
    {
        $question_id = $answerRequest->question_id;
        $optionIds = $answerRequest->optionIds;
        $question =  Question::query()->whereId($question_id)->first();
        
        abort_if($question->answered_type == null, 400, 'No answer type for this question');
        if ($question->answered_type == 'multiple') {
            return $this->single($question, $optionIds);
        }

        
    }


    protected function single(Question $question, array $optionIds)
    {
        $optionId =  $optionIds[0];
        $option_exists = Option::query()->where('id', $optionId)
            ->where('question_id', '=', $question->id)
            ->where('is_correct', true)->exists();

        abort_if(is_null($option_exists), 204, 'No correct option or Invalid option');

        return response()->json(
            [
                'is_correct' => $option_exists,
            ],
            status: 200
        );
    }

    protected function multiple(Question $question, array $optionIds)
    {
        $optionId =  $optionIds[0];
        $options = Option::query()->where('id', $optionId)
            ->where('question_id', '=', $question->id)
            ->where('is_correct', true)->get();

        abort_if($options->count() > 1, 400, 'Correct option can not be more than one');

        $option = $options->first();
    }
}
