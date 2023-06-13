<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
class MediaService {

    public function uploadImage($image){
        $url = null;

        if(! is_null($image)) {
            $ext = $image->extension();

            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($image);
            $image->encode(null, 90);
    
            $file_name = 'images/'.Str::random(15).'.'.$ext;
    
            $url = Storage::put($file_name, (string) $image);
            $url = Storage::url($file_name);
        }
        return $url;
    }
}
