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
              'answered_type' => $this->answered_type,
              'media_url' => $this->media_url,
              'image_url' => $this->image_url,
              'media_type' => $this->media_type,
              'language' => $this->language,
              'topic' => $this->topic,
            //   'fourite_question' => $this->fourites,
            'options' => OptionResource::collection($this->options->when($request->language_id, fn($query) => $query->where('language_id', $request->language_id)))
        ];
    }


    private function optionQeury()
    {
        $language_id = request()->get('language_id');
        return $this->options->when($language_id, fn($query) => $query->where('language_id', $language_id))->get();
    }
}