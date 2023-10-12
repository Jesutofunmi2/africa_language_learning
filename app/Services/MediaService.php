<?php

namespace App\Services;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use FFMpeg\FFMpeg;
use Cloudinary\Configuration\Configuration;
class MediaService
{
    public function uploadImage($image)
    {
        $url = null;

        if (!is_null($image)) {
            $ext = $image->extension();

            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($image);
            $image->encode(null, 90);

            $file_name = 'images/' . Str::random(15) . '.' . $ext;

            $url = Storage::put($file_name, (string) $image);
            $url = Storage::url($file_name);
        }
        return $url;
    }

    public function uploadAudio($audio)
    {
        $url = null;

        if (!is_null($audio)) {

            $ext = $audio->extension();
            $file_name = 'audios/' . Str::random(15) . '.' . $ext;
           
            $url = Storage::put( $file_name, $audio);
            $url = Storage::url($url);
        }
        return $url;
    }

    public function cloudinaryUpload()
    {
          
    }
}
