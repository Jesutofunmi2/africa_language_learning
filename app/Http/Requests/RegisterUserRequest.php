<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => ['required','string', 'max:254'],
            'lastname' => ['required','string', 'max:254'],
            'email' => ['required','email', 'min:5', 'max:100', 'unique:users,email'],
            'password' => ['required','string', 'min:4', 'max:50'],
            'confirm_password' => ['required', 'same:password'],
            'device_name' => ['sometimes', 'string']
        ];
    }
}
