<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PlayStudentAssignedModuleRequest extends FormRequest
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
            'id' => ['sometimes', 'integer'],
            'topic_id' => ['required', 'string', 'exists:topics,id'],
            'language_id' => ['required', 'integer']
        ];
    }
}
