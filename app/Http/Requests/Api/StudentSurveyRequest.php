<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StudentSurveyRequest extends FormRequest
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
            'school_id' => ['required', 'string','exists:schools,id'],
            'interested' => ['required', 'string'],
            'scale_of_1_5' => ['required', 'integer'],
            'opportunity' => ['required', 'string'],
            'ability' => ['required', 'string'],
            'prefer' => ['required', 'string'],
            'schools_app' => ['required', 'string'],
            'motivates' => ['required', 'string'],
        ];
    }
}
