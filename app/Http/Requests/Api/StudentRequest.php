<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'student_id'=> ['required'],
            'first_name' => ['sometimes', 'string'],
            'last_name' => ['sometimes', 'string'],
            'country' => ['sometimes', 'string'],
            'language' => ['sometimes', 'string'],
            'age' => ['sometimes', 'integer'],
            'gendar' => ['sometimes', 'string'],
        ];
    }
}
