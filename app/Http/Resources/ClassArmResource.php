<?php

namespace App\Http\Resources;

use App\Models\ClassArm;
use App\Models\Classes;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassArmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'class' => $this->classNameQuery(),
            'class_arm' => $this->classArmQuery(),
        ];
    }

   public function classArmQuery()
   {
       return ClassArm::where('id', $this->classarms_id)->get('name');
    }

    public function classNameQuery()
    {
        return Classes::where('id', $this->classes_id)->get('name'); 
    }
}
