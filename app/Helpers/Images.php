<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Images
{
    /*
    * Get image
    */
    public static function GetImage($image = null)
    {
        //Get image if exists
        if (!is_null($image) && !empty($image)) {
            if (File::exists('storage/web/images/' . $image)) {
                $storagePath = 'storage/web/images/' . $image;
            } else {
                $storagePath = 'image/no-image.png';
            }
            return redirect($storagePath);
        }

        //Set default image
        $storagePath = 'image/no-image.png';

        return Image::make($storagePath)->response();
    }

    /*
    * Get Fortress image
    */
    public static function GetFortImage($image = null)
    {
        if (!is_null($image)) {
            if (File::exists('image/sro/etc/' . $image)) {
                $storagePath = 'image/sro/etc/' . $image;
            } else {
                $storagePath = 'image/no-image.png';
            }
            return redirect($storagePath);
        }

        //Set default image
        $storagePath = 'image/no-image.png';

        return Image::make($storagePath)->response();
    }

    /*
    * Get Character image
    */
    public static function GetCharacterImage($image = null)
    {
        if (!is_null($image)) {
            if (File::exists('image/sro/chars/' . $image)) {
                $storagePath = 'image/sro/chars/' . $image;
            } else {
                $storagePath = 'image/no-image.png';
            }
            return redirect($storagePath);
        }


        //Set default image
        $storagePath = 'image/no-image.png';

        return Image::make($storagePath)->response();
    }
}
