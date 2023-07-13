<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'name' => ['required','string', 'max:254'],
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'email' => ['sometimes','email'],
            'image_url' => ['sometimes','image','mimes:jpeg,png,jpg','max:1024'],
            'address' => ['sometimes', 'string']
        ];

        
    }
}
