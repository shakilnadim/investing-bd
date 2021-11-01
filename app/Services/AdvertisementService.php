<?php

namespace App\Services;

use App\Adapters\Image\ImageUploader;
use App\Consts\Image;
use App\Exceptions\InvalidAdvertisementImageType;
use App\Exceptions\InvalidImageDimensionException;
use App\Exceptions\InvalidImageImageNameException;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Storage;

class AdvertisementService
{
    public function __construct(private ImageUploader $imageUploader)
    {
    }

    public function updateAd(Advertisement $advertisement, array $data) : Advertisement
    {
        $removeOldImage = false;
        $oldImage = $advertisement->image;
        if (isset($data['image'])) {
            $data['image'] = $this->resizeAndUploadImg($data['image'], $data['image_type']);
            $removeOldImage = true;
        }

        $data['is_published'] = $data['is_published'] ?? false;
        $advertisement->update($data);

        if ($removeOldImage) {
            Storage::delete($oldImage);
        }

        return $advertisement;
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
}
