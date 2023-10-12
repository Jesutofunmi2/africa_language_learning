<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuestionAnsweredRequest extends FormRequest
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
            'question_id' => ['required', 'string','exists:questions,id'],
            'topic_id' => ['required', 'string', 'exists:topics,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student Id doest not exists in the database',
            'question_id.required' => 'Question Id doest not exists in the database',
            'topic_id.required' => 'Topic Id doest not exists in the database',
        ];
    }
}
