<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FouriteRequest extends FormRequest
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
            'student_id' => ['required', 'string', 'exists:students,student_id'],
            'question_id' => ['string','exists:questions,id'],
            'question_name' => ['sometimes', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student Id doest not exists in the database',
            'question_id.required' => 'Question Id  invalid',
        ];
    }
}
