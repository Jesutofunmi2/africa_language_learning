<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DeleteClassRequest extends FormRequest
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
            'teacher_id'=> ['sometimes', 'string', 'exists:teachers,teacher_id'],
            'language_id' => ['sometimes','integer', 'exists:languages,id'],
            'class_id'=>['sometimes', 'string', 'exists:classes,id']
        ];
    }
}
