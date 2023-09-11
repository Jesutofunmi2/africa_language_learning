<?php

namespace App\Http\Resources;

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
            'description' => $this->description,
            'content' => $this->content,
            'objective' => $this->objective,
            'media_url' => $this->image_url,
            'type' => $this->type,
            'media_type' => $this->media_type,
            'questions' => QuestionResource::collection($this->questions),
            'question_count' => $this->questions->count(),
            'percentage' => $this->calculatePercentage(),
            'last_question_answered' => QuestionAnsweredResource::make($this->answereds->where('student_id', auth()->user()->id)->sortByDesc('update_at')->first())
        ];
    }

    public function calculatePercentage()
    {
        
        $question_count = $this->questions->count()+1;

        $question_answered = $this->answereds->where('student_id', auth()->user()->id)->count()+1;
        if ($question_count == 0 || $question_answered == 0) {
            return 0;
        }
        // $per = ($question_count  / $question_answered)/100;
        $per = ($question_count  / 100 );
        return $per;
    }
}
