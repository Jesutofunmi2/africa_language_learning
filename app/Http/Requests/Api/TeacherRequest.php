<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'school_id'=> ['sometimes', 'integer'],
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email'],
            'address' => ['sometimes', 'string'],
            'image_url' => ['sometimes','image','mimes:jpeg,png,jpg','max:1024'],
        ];
    }
}
