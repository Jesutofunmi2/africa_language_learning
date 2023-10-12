<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TeacherSurveyRequest extends FormRequest
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
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'teacher_id' => ['required', 'string','exists:teachers,teacher_id'],
            'years' => ['required', 'string'],
            'hours' => ['required', 'integer'],
            'challeges' => ['required', 'string'],
            'opinion' => ['required', 'string'],
            'resources' => ['required', 'string'],
            'confident' => ['required', 'string'],
            'method' => ['required', 'string'],
            'tools' => ['required', 'string'],
            'strategies' => ['required', 'string'],
            'familiar' => ['required', 'string'],
        ];
    }
}
