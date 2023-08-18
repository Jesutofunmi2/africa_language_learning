<?php

namespace App\Http\Resources;

use App\Models\Section;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'section'=>SectionResource::collection(Section::orderBy('created_at', 'asc')->where('language_id', $request->language_id)->has('topics')->get())
        ];
    }
}
