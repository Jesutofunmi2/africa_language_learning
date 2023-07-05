<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
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
            'instruction' => ['sometimes','string'],
            'language_id' => ['integer', 'required', 'exists:languages,id'],
            'course_id' => ['integer', 'required', 'exists:courses,id'],
            'answered_type' => ['required','in:text,multiple,single,puzzle'],
            'media_url' => 'sometimes|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav,video/mp4,mp4,video/x-flv,flv,video/quicktime,mov,jpeg,png,jpg,svg',
            'image_url' => ['sometimes','image','mimes:jpeg,png,jpg,svg','max:1024']
        ];
        
    }
}
