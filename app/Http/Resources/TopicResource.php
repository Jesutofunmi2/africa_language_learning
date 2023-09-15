<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'question_type' => $this->question_type,
            'description' => $this->description,
            'content' => $this->content,
            'objective' => $this->objective,
            'media_url' => $this->image_url,
            'type' => $this->type,
            'answered' => $this->answereds->where('student_id', auth()->user()->student_id),
            'media_type' => $this->media_type,
            'questions' => QuestionResource::collection($this->questionQeury()),
            'question_count' => $this->questionQeury()->count(),
            'percentage' => $this->calculatePercentage(),
            'last_question_answered' => QuestionAnsweredResource::make($this->answereds->where('student_id', auth()->user()->student_id)->sortByDesc('update_at')->first())
        ];
    }

    public function calculatePercentage()
    {
        $question_count = $this->questionQeury()->count();

        $question_answered = $this->answereds->where('student_id', auth()->user()->student_id)->count();
        if ($question_count == 0 || $question_answered == 0) {
            return 0;
        }
        $per = ($question_answered / $question_count) * 100;
        return round($per, 0);
    }


    private function questionQeury()
    {
        $language_id = request()->get('language_id');
        return $this->questions()->where('id', $this->id)
                    ->when($language_id,  fn ($query) => $query
                    ->whereRelation('options', 'language_id', '=', $language_id))->get();
    }
}
