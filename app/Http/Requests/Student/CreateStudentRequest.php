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
            'email' => ['email', 'min:5', 'max:100', 'unique:students,email'],
            'password' => ['string', 'min:4', 'max:50'],
            'school_id' => ['sometimes', 'string'],
            'image_url' => ['sometimes', 'string'],
            'language' => ['required', 'string'],
            'phone_number'=>['required', 'string'],
            'age'=> ['required', 'integer'],
            'country' => ['required', 'string'],
            'marital_status' => ['sometimes', 'string'],
            'gendar'=> ['required', 'string'],
            'how_do_you_see_us' => ['required', 'string']
        ];
    }
}
