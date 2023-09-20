<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignedModuleResource extends JsonResource
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
            'school_id' => $this->school_id,
            'teacher_id' => $this->teacher_id,
            'class_id' => ClassResource::make($this->class),
            'module' => $this->module,
            'deadline' => $this->deadline,
            'time' => $this->time,
            'no_attempt' => $this->no_attempt,
            'notification' => $this->notification
        ];
    }
}
