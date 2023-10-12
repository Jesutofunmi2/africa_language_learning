<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'ref' => $this->ref,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'type' => $this->type,
            'image_url' => asset($this->image_url),
            'user_id' => $this->user_id,
            'created_at' => $this->created_at
        ];
    }
}
