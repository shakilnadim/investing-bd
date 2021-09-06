<?php

namespace App\Services;

use App\Adapters\Image\ImageUploader;
use App\Consts\Image;
use App\Consts\Image as ImageConst;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;

class NewsImageService
{
    public function __construct(protected NewsImage $newsImage, protected ImageUploader $imageUploader)
    {}

    #[ArrayShape(['url' => "string", ImageConst::LARGE => "string", ImageConst::MEDIUM => "string", 'id' => "int"])]
    public function uploadInsideNewsImage($image, $uuid) : array
    {
        $dimensions = [config('investing.image.dimensions.'.Image::LARGE), config('investing.image.dimensions.'.Image::MEDIUM)];
        $paths = $this->imageUploader->resizeWithAspectRatio($image, $dimensions, 'news');
        $savedData = $this->saveToDb(json_encode($paths), $uuid);
        return ['url' => Storage::url($paths[0]), Image::LARGE => $paths[0], Image::MEDIUM => $paths[1], 'id' => $savedData->id];
    }

    private function saveToDb($paths, $uuid)
    {
        return $this->newsImage->create(['uuid' => $uuid, 'paths' => $paths]);
    }
}
