<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassWorkResource extends JsonResource
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
            'name' =>$this->name,
            'school_id'=>$this->school_id,
            'class_id'=>$this->class_id,
            'teacher_id'=>$this->teacher_id,
            'media_url' =>$this->media_url
        ];
    }
}
