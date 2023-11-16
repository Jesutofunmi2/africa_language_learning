<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuestionBatchUploadRequest extends FormRequest
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
            'language_id' => ['integer', 'required', 'exists:languages,id'],
            'topic_id' => ['integer', 'required', 'exists:topics,id'],
            'file' => ['required','mimes:xlsx,xls,csv','max:1024']
        ];
    }
}
