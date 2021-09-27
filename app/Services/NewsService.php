<?php

namespace App\Services;

use App\Adapters\Image\ImageUploader;
use App\Consts\Image;
use App\Facades\NewsImageServiceFacade;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;

class NewsService
{
    public function __construct(private News $news, private ImageUploader $imageUploader)
    {}

    public function storeNews(array $data) : News
    {
        $data['featured_img'] = json_encode($this->resizeAndUploadFeaturedImg($data['featured_img']));
        $data = $this->makeFormattedData($data);
        $news = new News($data);

        DB::transaction(function () use (&$news, $data){
            $news = auth()->user()->news()->save($news);
            NewsImageServiceFacade::removeUnusedNewsImages(json_decode($data['description']), $news);
        });

        return $news;
    }

    public function updateNews(News $news, array $data) : News
    {
        if (isset($data['featured_img'])) {
            $data['featured_img'] = json_encode($this->resizeAndUploadFeaturedImg($data['featured_img']));
            $this->removeFeaturedImage($news);
        }
        NewsImageServiceFacade::removeUnusedNewsImages(json_decode($data['description']), $news);

        $data = $this->makeFormattedData($data);
        $news->update($data);

        return $news;
    }

    public function updateStatus(News $news, $status) : bool
    {
        if ($status === 'publish') $updatedStatus = true;
        else $updatedStatus = false;
        return $news->update(['is_published' => $updatedStatus]);
    }

    public function getLatestPublishedFeaturedNews($limit) : Collection
    {
        return $this->news->with('category')->featured()->published()->betweenStartEndDate()->orderBy('id', 'desc')->limit($limit)->get();
    }

    #[ArrayShape([Image::LARGE => "string", Image::MEDIUM => "string", Image::THUMBNAIL => "string",  Image::XS => "string"])]
    private function resizeAndUploadFeaturedImg($image) : array
    {
        $resizingDimensions = [
            config('investing.image.dimensions.'.Image::LARGE),
            config('investing.image.dimensions.'.Image::MEDIUM),
            config('investing.image.dimensions.'.Image::THUMBNAIL),
            config('investing.image.dimensions.'.Image::XS),
        ];
        $resizedFeaturedImages = $this->imageUploader->resizeWithAspectRatio($image, $resizingDimensions, 'news/featured');
        return [Image::LARGE => $resizedFeaturedImages[0], Image::MEDIUM => $resizedFeaturedImages[1], Image::THUMBNAIL => $resizedFeaturedImages[2], Image::XS => $resizedFeaturedImages[3]];
    }

    private function removeFeaturedImage(News $news) : bool
    {
        $images = array_values(json_decode($news->featured_img, true));
        return Storage::delete($images);
    }

    private function getCategoryId(array $data) : int
    {
        return $data['sub_category'] ?? $data['parent_category'];
    }

    private function makeFormattedData(array $data) : array
    {
        $data['is_published'] = $data['is_published'] ?? false;
        $data['is_featured'] = $data['is_featured'] ?? false;
        $data['category_id'] = $this->getCategoryId($data);
        $data['start_date'] = get_start_of_date_timestamp($data['start_date']);
        $data['end_date'] = get_end_of_date_timestamp($data['end_date']);
        return $data;
    }
}
