<?php
namespace App\Services;

use File;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function save($image){
        $destination = public_path().'/backend_images/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);

        
        $thumb_path = public_path().'/backend_images/thumb/'.$image_name;
        $img = Image::make($image->getRealPath());
        $img->resize(null,400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumb_path);

        return $image_name;
    }

    public static function delete($image){
        $destination = public_path().'/backend_images/'.$image;
        $thumb_path = public_path().'/backend_images/thumb/'.$image;

        if ( File::exists($destination)) {
            File::delete($destination);
        }
        if ( File::exists($thumb_path)) {
            File::delete($thumb_path);
        }
        return true;
    }
}