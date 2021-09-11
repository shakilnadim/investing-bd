<?php

namespace App\Services;

use App\Adapters\Image\ImageUploader;
use App\Consts\Image;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;

class NewsService
{
    public function __construct(private News $news, private ImageUploader $imageUploader)
    {}

    public function storePost(array $data) : News
    {
        $resizedFeaturedImages = $this->uploadAndResize($data['featured_img']);
        $news = new News([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'category_id' => $data['sub_category'] ?? $data['parent_category'],
            'meta' => $data['meta'],
            'is_published' => $data['is_published'] ?? false,
            'description' => $data['description'],
            'featured_img' => json_encode($resizedFeaturedImages),
        ]);
        return auth()->user()->news()->save($news);
    }

    #[ArrayShape([Image::LARGE => "string", Image::MEDIUM => "string", Image::THUMBNAIL => "string"])]
    private function uploadAndResize($image) : array
    {
        $resizingDimensions = [
            config('investing.image.dimensions.'.Image::LARGE),
            config('investing.image.dimensions.'.Image::MEDIUM),
            config('investing.image.dimensions.'.Image::THUMBNAIL),
        ];
        $resizedFeaturedImages = $this->imageUploader->resizeWithAspectRatio($image, $resizingDimensions, 'news/featured');
        return [Image::LARGE => $resizedFeaturedImages[0], Image::MEDIUM => $resizedFeaturedImages[1], Image::THUMBNAIL => $resizedFeaturedImages[2]];
    }
}
