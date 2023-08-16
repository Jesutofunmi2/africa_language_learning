<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FouriteResource extends JsonResource
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
            'question_id' => $this->question_id,
            'student_id' => $this->student_id,
            'question'=> $request->language_id ? QuestionResource::collection($this->question->where('language_id', $request->language_id)->where('topic_id', $request->topic_id)->get())->unique('question_id'): QuestionResource::make($this->question),
            //'option'=>$this->question->options
        ];
    }
}
