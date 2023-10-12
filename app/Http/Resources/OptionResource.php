<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'title' => $this->question->answered_type == 'puzzle' ? $this->puzzle_formatted_option : $this->title,
            'hint' => $this->question->answered_type == 'puzzle' ? $this->hint: '',
            'media_url' => $this->media_url,
            'media_type' => $this->media_type,
            'image_url' =>  $this->image_url,
        ];
    }
}
