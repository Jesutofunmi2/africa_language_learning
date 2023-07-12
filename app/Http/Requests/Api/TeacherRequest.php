<?php

namespace App\Http\Requests\Api;

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
            'school_id'=> ['required', 'integer', 'exists:schools,id'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'min:5', 'max:100'],
            'address' => ['required', 'string'],
            'image_url' => ['required','image','mimes:jpeg,png,jpg','max:2024'],
            'teacher_id'=> ['sometimes', 'string', 'exists:teachers,teacher_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'school_id.required' => 'School Id doest not exists in the database',
            'image_url.required' => 'Image size is too large, less than 1mb required',
            'name.required' => 'Teacher name is required',
            'email.required' => 'Email is required or Exists',
            'address.required' => 'Address is missing'
        ];
    }
}
