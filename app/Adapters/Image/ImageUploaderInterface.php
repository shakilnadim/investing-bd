<?php

namespace App\Adapters\Image;

interface ImageUploaderInterface
{
    public function resize($image, array $dimensions, string $directory, string $imageName);
    public function resizeWithAspectRatio($image, array $dimensions, string $directory, string $imageName);
}
