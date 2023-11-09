<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateBatchStudent extends FormRequest
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
            'batch_file' => 'required|file|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
            'session' => 'required|integer',
            'term' => ['required','regex:/(First|Second|Third)/'],
            'class_id' => ['required', 'integer', 'exists:classes,id'],
            'class_arm_id' => ['required', 'integer', 'exists:class_arms,id'],
            'school_id' =>['required', 'integer', 'exists:schools,id'],
            
        ];
    }

    public function messages() : array
    {
        return [
                'batch_file.required' => 'Please upload an appropriate file',
                'batch_file.file' => 'Please upload an appropriate file',
                'batch_file.mimetypes' => 'Only Microsoft Excel spreadsheets are allowed',
                'class_id.required' => 'Please select a Class',
                'class_arm_id.required' => 'Please select a Class Arm',
        ];
    }
}
