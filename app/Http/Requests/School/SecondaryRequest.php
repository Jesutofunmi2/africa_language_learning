<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;

class SecondaryRequest extends FormRequest
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
            'email' => ['required','email', 'min:5', 'max:100'],
            'password' => ['sometimes','string', 'min:8', 'max:50'],
            'confirm_password' => ['sometimes', 'same:password'],
            'image_url' => ['sometimes', 'image', 'mimes:jpeg,png,jpg'],
            'country' => ['sometimes', 'string'],
            'phone_number'=>['sometimes', 'string'],
            'no_of_pupil'=> ['sometimes', 'integer'],
            'school_name' => ['sometimes', 'string', 'max:254'],
            'state' => ['sometimes', 'string', 'max:254'],
            'lga' => ['sometimes', 'string', 'max:254'],
            'type'=> ['required', 'string'],
            'how_do_you_see_us' => ['sometimes', 'string']
        ];
    }
}
