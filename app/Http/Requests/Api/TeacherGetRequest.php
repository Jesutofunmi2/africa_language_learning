<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TeacherGetRequest extends FormRequest
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
            'teacher_id'=> ['required', 'string', 'exists:teachers,teacher_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'teacher_id.required' => 'Teacher Id doest not exists in the database',
        ];
    }
}
