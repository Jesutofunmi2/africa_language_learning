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
            'questions'=> $this->questions
        ];
    }
}
