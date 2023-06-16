<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_email,
            'email' => $this->email,
            'student_id' => $this->student_id,
            'language' => $this->language,
            'phone_number' => $this->phone_number,
            'gendar' => $this->gendar,
            'school_id' => $this->school_id,
            'age' => $this->age,
            'marital_status' => $this->marital_status,
            'how_do_you_see_us' => $this->how_do_you_see_us,
            'country' => $this->country,
            'created_at' => $this->created_at
        ];
    }
}
