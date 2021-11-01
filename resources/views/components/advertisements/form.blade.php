@props(['advertisement', 'method'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'w-full lg:w-4/6 mx-auto mt-5']) }} enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <input type="hidden" value="{{ $advertisement->placement }}">
    <x-form.text label="Advertiser *" labelFor="advertiser" name="advertiser" value="{{ old('advertiser') ?? $advertisement->advertiser ?? '' }}"></x-form.text>
    <x-form.text label="Title" labelFor="title" name="title" value="{{ old('title') ?? $advertisement->title ?? '' }}" class="mt-3"></x-form.text>
    <x-form.text label="Sub Title" labelFor="sub-title" name="sub_title" value="{{ old('sub_title') ?? $advertisement->sub_title ?? '' }}" class="mt-3"></x-form.text>
    <x-form.text label="Redirect Link *" labelFor="link" name="link" value="{{ old('link') ?? $advertisement->link ?? '' }}" class="mt-3"></x-form.text>
    <x-form.checkbox label="Publish this ad" labelFor="is-published" name="is_published" :value="1" :checked="old('is_published') == 1 || (isset($advertisement) && $advertisement->is_published)" class="mt-3"></x-form.checkbox>
    <x-form.img label="Image *" labelFor="image" name="image" src="{{ $advertisement->image ? \Illuminate\Support\Facades\Storage::url($advertisement->image) : null }}" class="mt-3"></x-form.img>
    <x-form.normal-select label="Image Type *" labelFor="image-type" name="image_type" :options="\App\Consts\Image::AD_IMAGE_TYPES" value="{{ old('image_type') ?? $advertisement->image_type ?? '' }}" placeholder="Select Image Type" class="mt-3"></x-form.normal-select>
    <x-inc.dynamic-btn class="ml-auto mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit"><x-icons.pencil-alt class="h-5 w-5 mr-1"></x-icons.pencil-alt> Update Advertisement</x-inc.dynamic-btn>
</form>
