<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AssignTeacherToClass extends FormRequest
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
            'data'=>['required', 'array','min:1'],
            'data.*.class_id'=>['integer', 'required', 'exists:classes,id'],
            'data.*.classarm_id' => ['integer', 'required', 'exists:class_arms,id'],
            'teacher_id' => ['string', 'required','exists:teachers,teacher_id' ]
        ];
    }
}
