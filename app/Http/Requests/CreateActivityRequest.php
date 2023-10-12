<?php

namespace App\Http\Requests;

use App\Rules\ActivityPlanExist;
use Illuminate\Foundation\Http\FormRequest;

class CreateActivityRequest extends FormRequest
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
            'user_id' => ['required_if:type,personal'],
            'description' => ['required', 'string', 'max:1000'],
            'type' => ['required', new ActivityPlanExist],
            'date' => ['required', 'date'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024']
        ];
    }
}
