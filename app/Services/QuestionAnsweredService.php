<?php

namespace App\Services;

use App\Models\Answered;
use Illuminate\Support\Facades\DB;

class QuestionAnsweredService
{

    public function addQuestionAnswered(array $data): Answered
    {
        $questionAnswered = new Answered;
        $answered = Answered::where('student_id', '=', $data['student_id'])
            ->where('question_id', '=', $data['question_id'])
            ->where('topic_id', '=', $data['topic_id'])->exists();

        if ($answered == true) {
            return $questionAnswered;
        }

        DB::transaction(function () use (&$questionAnswered, $data,) {

            $questionAnswered->student_id = $data['student_id'];
            $questionAnswered->question_id = $data['question_id'];
            $questionAnswered->topic_id = $data['topic_id'];
            $questionAnswered->save();
        });

        return $questionAnswered;
    }
}
