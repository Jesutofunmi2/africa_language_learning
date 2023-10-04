<?php

namespace App\Http\Resources;

use App\Models\ClassArm;
use App\Models\Classes;
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
            'id'=>$this->id,
            'username' => $this->first_name,
            'last_name' => $this->last_name,
            'student_id' => $this->student_id,
            'language' => $this->language,
            'gendar' => $this->gendar,
            'school' => $this->school,
            'class' => ClassResource::make($this->class),
            'classarm' => $this->classarmQuery(),
            'age' => $this->age,
            'country' => $this->country,
            'count_down' => $this->future,
            'survey_status' => $this->survey_status == 0 ? false: true, 
        ];
    }

    public function classQuery()
    {
     // return Classes::where('id', $this->class_id)->value('classs_room_name');
    }

    public function classarmQuery()
    {
      return ClassArm::where('id', $this->classarm_id)->value('name');
    }
}
