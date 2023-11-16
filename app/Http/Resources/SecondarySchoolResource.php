<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SecondarySchoolResource extends JsonResource
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
            'email' => $this->email,
            'school_name' => $this->school_name,
            'state' => $this->state,
            'lga'=> $this->lga,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}
