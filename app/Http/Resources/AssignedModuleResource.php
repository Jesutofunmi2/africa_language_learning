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
            'notification' => $this->notification,
            'mark'=>$this->mark,
            //'questions' => QuestionResource::collection($this->questionQeury()),
        ];
    }

    private function questionQeury()
    {
        $language_id = request()->get('language_id');
        return $this->questions()->where('topic_id', $this->id)
                    ->when($language_id,  fn ($query) => $query
                    ->whereRelation('options', 'language_id', '=', $language_id))->inRandomOrder()->get();
    }
}
