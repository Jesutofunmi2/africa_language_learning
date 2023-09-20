<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AssignedModuleRequest extends FormRequest
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
            'school_id' => ['integer','required', 'exists:schools,id'],
            'teacher_id'=> ['required', 'string', 'exists:teachers,teacher_id'],
            'class_id' => ['integer' ,'required','exists:classes,id'],
            'data' => ['required', 'array', 'min:1'],
            'data.*.module'=>['integer', 'required'],
            'data.*.deadline' => ['date', 'required'],
            'data.*.time'=>['integer', 'required'],
            'data.*.no_attempt'=>['integer', 'required'],
            'data.*.notification' => ['boolean', 'required'],
            
        ];
    }
}
