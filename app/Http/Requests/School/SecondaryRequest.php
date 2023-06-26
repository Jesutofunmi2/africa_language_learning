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
            'image_url' => ['sometimes', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'type'=> ['required', 'string'],
            'email' => ['required','email', 'min:5', 'max:100', 'unique:admins,email'],
            'state' => ['required', 'string'],
            'lga' => ['required', 'string'],
            'address' => ['required', 'string']
        ];
    }
}
