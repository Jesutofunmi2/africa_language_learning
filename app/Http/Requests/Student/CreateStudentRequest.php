<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'first_name' => ['required','string', 'max:254'],
            'last_name' => ['required','string', 'max:254'],
            'student_id' => ['sometimes','string', 'min:5', 'max:100', 'unique:students,student_id'],
            'password' => ['string', 'min:4', 'max:50'],
            'school_id' => ['required', 'string','exists:schools,id'],
            'image_url' => ['sometimes', 'string'],
            'language' => ['required', 'string'],
            'country' => ['sometimes', 'string'],
            'gender'=> ['required', 'string'],
            'phone_number'=> ['sometimes', 'string'],
            'age' => 'required|numeric|gt:0',
            'class_id' => ['required', 'integer', 'exists:classes,id'],
            'classarm_id' => ['required', 'integer', 'exists:class_arms,id'],
            'term' =>['required', 'string'],
            'session' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is missing',
            'last_name.required' => 'Last Name is missing',
            'school_id.required' => 'School Id is required',
            'language.required' => 'language is missing',
            'age.required' => 'age is missing or not an integer value',
            'gendar.required' => 'gender is missing',
            'class_id.required' => 'class id is required',
            'classarm_id.required' => 'class arm id is required',
            'term' => 'term is required',
            'session' => 'session is required'
        ];
    }
}
