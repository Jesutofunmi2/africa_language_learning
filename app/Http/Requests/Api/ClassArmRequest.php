<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClassArmRequest extends FormRequest
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
            'school_id'=> ['required', 'integer', 'exists:schools,id'],
            'language_id' => ['sometimes','integer', 'exists:languages,id'],
            'data' => ['required', 'array', 'min:1'],
            'data.*.name'=>['string', 'required'],
            'class_id' => ['sometimes', 'integer', 'exists:classes,id']
        ];
    }
}
