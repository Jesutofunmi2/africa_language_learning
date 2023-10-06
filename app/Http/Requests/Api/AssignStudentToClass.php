<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AssignStudentToClass extends FormRequest
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
            'data' => ['required', 'array', 'min:1'],
            'data.*.student_id' => ['string', 'required', 'exists:students,student_id'],
            'class_id' => ['integer', 'required', 'exists:classes,id'],
            'classarm_id' => ['integer', 'required', 'exists:class_arms,id'],
            'session' => ['string', 'required'],
            'term' => ['required', 'string'],
        ];
    }
}
