<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'teacher_id' => $this->teacher_id,
            'name' => $this->name,
            'email' => $this->email,
            'school' => $this->school,
            'address' => $this->address,
            'image_url' => $this->image_url,
            'count_down' => $this->future,
            'survey_status' => $this->survey_status == 0 ? false: true, 
        ];
    }
}
