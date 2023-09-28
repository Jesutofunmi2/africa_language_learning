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
        $puzzle = $answerRequest->puzzle_text;

        $question =  Question::query()->whereId($question_id)->first();

        abort_if($question->answered_type == null, 400, 'No answer type for this question');
        if ($question->answered_type == 'single') {
            return $this->single($question, $optionIds);
        }

        if ($question->answered_type == 'multiple') {
            return $this->multiple($question, $optionIds);
        }
        if ($question->answered_type == 'puzzle') {
            return $this->puzzle($question, $optionIds, $puzzle);
        }

        
    }

    protected function multiple(Question $question, array $optionIds)
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

    protected function single(Question $question, array $optionIds)
    {
        $optionId =  $optionIds[0];
        $option_exists = Option::query()->where('id', $optionId)
            ->where('question_id', '=', $question->id)
            ->where('is_correct', true)->exists();

       // abort_if(is_null($option_exists), 204, 'No correct option or Invalid option');

        return response()->json(
            [
                'is_correct' => $option_exists,
            ],
            status: 200
        );
    }

    public function puzzle(Question $question, array $optionIds, array $puzzle)
    {
        $title =  implode(" ", $puzzle);
        $optionId =  $optionIds[0];
        $option_exists = Option::query()->where('id', $optionId)
            ->where('question_id', '=', $question->id)->where('title', $title)
            ->where('is_correct', true)->exists();
        abort_if(is_null($option_exists), 204, 'No correct option or Invalid option');

        return response()->json(
            [
                'is_correct' => $option_exists,
            ],
            status: 200
        );
    }
}
