<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
                'title' => ['string', 'required'],
                'course_id' => ['uuid', 'required', 'exists:courses,id'],
                'level' => ['string', 'required'],
                'category' => ['string', 'required'],
            ];
       
    }
}
