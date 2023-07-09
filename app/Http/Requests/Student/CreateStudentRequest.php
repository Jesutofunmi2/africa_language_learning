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
            'language' => ['sometimes', 'string'],
            'country' => ['sometimes', 'string'],
            'gendar'=> ['sometimes', 'string'],
            'phone_number'=> ['sometimes', 'string'],
            'age' => ['sometimes', 'string']
        ];
    }
}
