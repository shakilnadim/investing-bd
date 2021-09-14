<?php

namespace App\Services;

use App\Adapters\Image\ImageUploader;
use App\Consts\Image;
use App\Consts\Image as ImageConst;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Database\Eloquent\Collection;
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

    public function removeUnusedImagesUuid(object $description, News $news) : Collection | null
    {
        $images = $this->getImagesByUuid($description->uuid);
        if($images->count() === 0) return null;
        $usedImageIds = $this->getUsedImageIds($description->blocks);

        return $images->filter(function ($value, $key) use ($usedImageIds, $news){
            if(!isset($usedImageIds[$value->id])){
                $this->removeFromDisk(json_decode($value->paths));
                $this->removeFromDb($value);
                return false;
            }

            $this->createRelationshipWithNews($value, $news);
            return true;
        });
    }

    private function createRelationshipWithNews($image, $news)
    {
        $image->news()->associate($news);
        $image->save();
    }

    private function removeFromDb($data) : bool
    {
        return $data->delete();
    }

    private function removeFromDisk(array|string $paths) : bool
    {
        return Storage::delete($paths);
    }

    private function getImagesByUuid(string $uuid) : Collection
    {
        return $this->newsImage->where('uuid', $uuid)->get();
    }

    private function getUsedImageIds(array $blocks) : array
    {
        $usedImageIds = [];
        foreach ($blocks as $block){
            if ($block->type === 'image'){
                $usedImageIds[$block->data->file->id] = true;
            }
        }
        return $usedImageIds;
    }

    private function saveToDb($paths, $uuid)
    {
        return $this->newsImage->create(['uuid' => $uuid, 'paths' => $paths]);
    }
}
