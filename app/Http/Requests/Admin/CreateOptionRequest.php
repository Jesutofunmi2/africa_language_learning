<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateOptionRequest extends FormRequest
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
            'language_id' => ['integer', 'required', 'exists:languages,id'],
            'question_id' => ['uuid', 'required', 'exists:questions,id'],
            'media_url' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav,video/mp4,mp4,video/x-flv,flv,video/quicktime,mov,jpeg,png,jpg',
            'image_url' => ['sometimes', 'image', 'mimes:jpeg,png,jpg'],
            'is_correct' => ['boolean']
        ];
    }
}
