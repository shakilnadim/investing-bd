<?php

namespace App\Adapters\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InterventionImageUploader extends ImageUploader
{
    public function uploadWIthAspectRatio($image, int $width, int $height, string $path) : bool
    {
        $format = pathinfo($path, PATHINFO_EXTENSION);
        $image = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($format);
        return Storage::put($path, $image);
    }
}
