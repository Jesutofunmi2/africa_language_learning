<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
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
            'question_title'=> ['string','required'],
            'question_instruction' => ['string', 'required'],
            'language_id'=> ['integer', 'required'],
            'course_id'=>['integer', 'required'],
            'question_id'=>['required', 'integer'],
            'answered_type'=>['required', 'emun'],
            'media_type'=>['string', 'required'],
            'media_url'=>['string', 'required'],
        ];
    }
}
