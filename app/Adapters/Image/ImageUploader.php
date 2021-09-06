<?php

namespace App\Adapters\Image;

use App\Exceptions\InvalidImageDimensionException;
use App\Exceptions\InvalidImageImageNameException;
use Illuminate\Support\Str;

abstract class ImageUploader
{
    public function resizeWithAspectRatio($image, array $dimensions, string $directory = null, string $imageName = null) : array
    {
        $images = [];
        $baseName = $this->makeBaseImageName($imageName);
        foreach ($dimensions as $dimension){
            list($width, $height) = $this->parseDimension($dimension);
            $path = $this->makePath($image, $baseName, $dimension, $directory);

            if ($this->uploadWIthAspectRatio($image, $width, $height, $path)) $images[] = $path;
        }
        return $images;
    }

    /**
     * @throws InvalidImageDimensionException
     */
    public function parseDimension(string $dimension) : array
    {
        $dimension = explode('x', $dimension);
        if (count($dimension) !== 2 || !is_numeric($dimension[0]) || !is_numeric($dimension[1])) throw new InvalidImageDimensionException();
        return [(int)$dimension[0], (int)$dimension[1]];
    }

    public function makePath($image, string $baseName, string $dimension, string $directory=null) : string
    {
        return "{$this->appendSlashToDirectory($directory)}{$baseName}-{$dimension}.{$image->extension()}";
    }

    public function appendSlashToDirectory($directory) : string
    {
        if ($directory === null) return '';
        return str_ends_with($directory, '/') ? $directory : $directory . '/';
    }

    /**
     * @throws InvalidImageImageNameException
     */
    private function makeBaseImageName($imageName = null) : string
    {
        if ($imageName !== null) {
            $imageName = explode('.', $imageName);
            if (count($imageName) !== 2) throw new InvalidImageImageNameException();
            return $imageName[0];
        }
        return Str::random(10) . uniqid();
    }

    abstract function uploadWIthAspectRatio($image, int $width, int $height, string $path) : bool;
}
