<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'media_url' => 'sometimes|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav,video/mp4,mp4,video/x-flv,flv,video/quicktime,mov,jpeg,png,jpg',
            'image_url' => ['sometimes','image','mimes:jpeg,png,jpg','max:1024']
        ];
    }
}
