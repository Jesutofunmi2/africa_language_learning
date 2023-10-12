<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class AssignmentFileRequest extends FormRequest
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
            'school_id'=> ['required', 'integer', 'exists:schools,id'],
            'teacher_id'=> ['required', 'string', 'exists:teachers,teacher_id'],
            'name' => ['sometimes', 'string'],
            'class_id'=>['required', 'integer', 'exists:classes,id'],
            'media_url' => ['sometimes', 'mimes:pdf,zip,application/octet-stream,audio/mpeg,mpga,mp3,wav,video/mp4,mp4,video/x-flv,flv,video/quicktime,mov,jpeg,png,jpg'],
            'mark' => ['required', 'integer'],
            'date' => ['date', 'after:' . Carbon::now()],
            'notification' => ['boolean', 'sometimes'],
        ];
    }
}
