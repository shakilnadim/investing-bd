<?php

namespace App\Services;

use App\Actions\CacheRemover;
use App\Adapters\Image\ImageUploader;
use App\Consts\CacheEvents;
use App\Exceptions\AdIsNotPublishable;
use App\Exceptions\InvalidAdvertisementImageType;
use App\Exceptions\InvalidImageDimensionException;
use App\Exceptions\InvalidImageImageNameException;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AdvertisementService
{
    private bool $hasNewImage = false;
    private string $oldImage = '';

    public function __construct(private ImageUploader $imageUploader, private Advertisement $advertisement)
    {
    }

    public function getPublishedAds() : Collection
    {
        return $this->advertisement->published()->get();
    }

    public function getCachedPublishedAds() : Collection
    {
        if (!Cache::has('ads')) {
            Cache::put('ads', $this->getPublishedAds());
        }
        return Cache::get('ads', function (){
            return $this->getPublishedAds();
        });
    }

    /**
     * @throws InvalidImageDimensionException
     * @throws InvalidImageImageNameException
     * @throws InvalidAdvertisementImageType
     */
    public function updateAd(Advertisement $advertisement, array $data) : Advertisement
    {
        $data['image'] = $this->uploadImageIfAvailable($advertisement, $data);
        $data['is_published'] = $data['is_published'] ?? false;
        $advertisement->update($data);

        $this->deleteOldImageIfNewImageUploaded();

        (new CacheRemover())->handle(CacheEvents::AD_UPDATE);

        return $advertisement;
    }

    /**
     * @throws AdIsNotPublishable
     */
    public function updateStatus(Advertisement $advertisement, string $status) : bool
    {
        if ($status === 'publish' && !$this->isAdPublishable($advertisement)) throw new AdIsNotPublishable();

        (new CacheRemover())->handle(CacheEvents::AD_UPDATE);
        return $advertisement->update(['is_published' => $status === 'publish']);
    }

    private function isAdPublishable(Advertisement $advertisement) : bool
    {
        if ($advertisement->title && $advertisement->image && $advertisement->link && $advertisement->image_type) return true;
        return false;
    }

    /**
     * @throws InvalidImageDimensionException
     * @throws InvalidImageImageNameException
     * @throws InvalidAdvertisementImageType
     */
    private function resizeAndUploadImg($image, $imageType) : string
    {
        $resizingDimension = [config('investing.image.dimensions.'.$imageType)];

        if (count($resizingDimension) === 0) throw new InvalidAdvertisementImageType();

        $resizedFeaturedImages = $this->imageUploader->resizeWithAspectRatio($image, $resizingDimension, 'advertisements');
        return $resizedFeaturedImages[0];
    }

    /**
     * @throws InvalidImageDimensionException
     * @throws InvalidImageImageNameException
     * @throws InvalidAdvertisementImageType
     */
    private function uploadImageIfAvailable(Advertisement $advertisement, array $data) : string | null
    {
        if (isset($data['image'])) {
            $this->hasNewImage = true;
            if ($advertisement->image) $this->oldImage = $advertisement->image;
            return $this->resizeAndUploadImg($data['image'], $data['image_type']);
        }
        return null;
    }

    private function deleteOldImageIfNewImageUploaded() : void
    {
        if ($this->hasNewImage && $this->oldImage) Storage::delete($this->oldImage);
    }
}
