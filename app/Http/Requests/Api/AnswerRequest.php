<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            'question_id' => ['uuid','exists:questions,id'],
            'optionIds' => ['array','min:1'],
            'optionIds.*' => ['exists:options,id'],
            'puzzle_text' => ['sometimes', 'array']
        ];
    }
}
