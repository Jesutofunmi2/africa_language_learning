<?php

namespace App\Http\Resources;

use App\Models\Language;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            'language' => $this->languageQuery(),
            'language_id' => $this->language_id,
            'classs_room_name' => $this->name,
            'class_arms' => ClassArmResource::collection($this->classarm)
        ];
    }

    public function languageQuery()
    {
        return Language::query()->where('id', $this->language_id)->where('status', 1)->value('name');
    }

    
}
