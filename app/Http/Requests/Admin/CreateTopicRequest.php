<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['string', 'required'],
            'section_id' => ['uuid', 'required', 'exists:sections,id'],
            'type' => ['sometimes', 'string'],
            'content' => ['sometimes', 'string'],
            'objective' => ['sometimes', 'string'],
            'description' => ['string', 'sometimes'],
            'image_url' => ['sometimes','image','application/octet-stream,audio/mpeg,mpga,mp3,wav,video/mp4,mp4,video/x-flv,flv,video/quicktime,mov,jpeg,png,jpg','max:10240'],
        ];
    }
}
