<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Language;

class QuestionResource extends JsonResource
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
              'instruction' => $this->instruction,
              'next_question_id' => $this->next_question_id,
              'media_url' => $this->media_url,
              'image_url' => $this->image_url,
              'media_type' => $this->media_type,
              'language' => $this->language,
              'course' => $this->course
        ];
    }
}
