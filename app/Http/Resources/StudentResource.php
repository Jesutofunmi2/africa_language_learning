<?php

namespace App\Http\Resources;

use App\Models\ClassArm;
use App\Models\Classes;
use App\Models\StudentClassArm;
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
            'class' => $this->classNameQuery(),
            'classarm' => $this->classarmNameQuery(),
            'age' => $this->age,
            'country' => $this->country,
            'count_down' => $this->future,
            'survey_status' => $this->survey_status == 0 ? false: true, 
        ];
    }

    public function classarmNameQuery()
    {
      return ClassArm::where('id', $this->classarmIdQuery())->value('name');
    }

    public function classarmIdQuery()
    {
      return StudentClassArm::orderBy('id', 'DESC')->where('student_id', $this->student_id)->value('classarms_id');
    }
    public function classIdQuery()
    {
       return StudentClassArm::orderBy('id', 'DESC')->where('student_id', $this->student_id)->value('classes_id'); 
    }
   
    public function classNameQuery()
    {
       return Classes::where('id', $this->classIdQuery())->value('name'); 
    }

}
