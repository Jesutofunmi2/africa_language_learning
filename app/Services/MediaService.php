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

    public function uploadDocument($pdf)
    {
        $url = null;
        if (!is_null($pdf)) {
        $ext = $pdf->extension();

        if($ext == 'pdf') {

            $pdfFile = $pdf;

            $path = $pdfFile->store('pdfs', 's3'); 
            $file_name = 'pdfs/' . Str::random(15) . '.' . $ext;

             $url = Storage::put($file_name, (string) $path);
             $url = Storage::url($file_name);
         } else {

            $ext = $pdf->extension();

            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($pdf);
            $image->encode(null, 90);

            $file_name = 'images/' . Str::random(15) . '.' . $ext;

            $url = Storage::put($file_name, (string) $image);
            $url = Storage::url($file_name);
          }
        }
        return $url;
    }
}
