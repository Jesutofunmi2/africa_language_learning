<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentSurveyResource extends JsonResource
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
            'student_id' => $this->student_id,
            'student_survey' => $this->studentData($this->student_id),
        ];
    }

    private function studentData ($id){
         
        $student =  Student::where('student_id', $id)->get();
        return $student[0]['survey_status'] === 0 ? false: true ;
        
    }
}
