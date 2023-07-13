<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'language_id' => ['required','integer','exists:languages,id'],
            'course_id' => ['required','integer','exists:courses,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.required' => 'Language Id doest not exists in the database',
            'course_id.required' => 'Course Id  invalid',
        ];
    }
}
