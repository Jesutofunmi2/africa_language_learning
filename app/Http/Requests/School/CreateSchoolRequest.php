<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;

class CreateSchoolRequest extends FormRequest
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
            'name' => ['required','string', 'max:254'],
            'email' => ['required','email', 'min:5', 'max:100', 'unique:schools,email'],
            'password' => ['required','string', 'min:4', 'max:50'],
            'confirm_password' => ['required', 'same:password'],
            'image_url' => ['required', 'string'],
            'country' => ['required', 'string'],
            'phone_number'=>['required', 'string'],
            'no_of_pupil'=> ['required', 'integer', 'max:254'],
            'school_name' => ['required', 'string', 'max:254'],
            'type'=> ['required', 'string'],
            'how_do_you_see_us' => ['required', 'string']
        ];
    }
}
