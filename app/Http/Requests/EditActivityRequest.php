<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditActivityRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'user_id' => ['sometimes'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg', 'max:1024']
        ];
    }
}
