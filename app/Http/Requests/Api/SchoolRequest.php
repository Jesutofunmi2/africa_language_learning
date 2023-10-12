<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'school_id.required' => 'School Id doest not exists in the database',
        ];
    }
}
