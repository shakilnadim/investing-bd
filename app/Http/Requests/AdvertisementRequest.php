<?php

namespace App\Http\Requests;

use App\Consts\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        $rules = [
            'advertiser' => 'string|required',
            'title' => 'string|nullable',
            'sub_title' => 'string',
            'link' => 'required|url',
            'is_published' => 'nullable',
            'image_type' => ['required', 'string', Rule::in(Image::AD_IMAGE_TYPES)],
        ];
        if (!$this->advertisement->image) $rules['image'] = 'required|image|max:5000';

        return $rules;
    }
}
