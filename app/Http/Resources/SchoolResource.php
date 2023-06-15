<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'school_name' => $this->school_name,
            'phone_number' => $this->phone_number,
            'image_url' => $this->image_url,
            'no_of_pupil' => $this->no_of_pupil,
            'country' => $this->country,
            'how_do_you_see_us' => $this->how_do_you_see_us,
            'type' => $this->type,
        ];
    }
}
