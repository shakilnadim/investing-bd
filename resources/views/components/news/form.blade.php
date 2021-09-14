@props(['news' => null, 'method', 'categories'])

{{--this entire form is being submitted from editor.js with submit event listener--}}
<form {{ $attributes->merge(['method' => 'post', 'class' => 'w-full lg:w-4/6 mx-auto mt-5 news-form', 'enctype' => 'multipart/form-data']) }}>
    @csrf
    @isset($method)
        @method($method)
        <x-inc.dynamic-btn class="mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit">
            <x-icons.pencil-alt class="h-5 w-5 mr-1"></x-icons.pencil-alt> Update News
        </x-inc.dynamic-btn>
    @else
        <x-inc.dynamic-btn class="ml-auto mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit">
            <x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create News
        </x-inc.dynamic-btn>
    @endisset

    <x-form.text label="Title" labelFor="title" name="title" value="{{ old('title') ?? $news->title ?? '' }}"></x-form.text>
    <x-form.text label="Slug" labelFor="slug" name="slug" value="{{ old('slug') ?? $news->slug ?? '' }}" class="mt-3"></x-form.text>
    <x-news.categories-select :categories="$categories" :news="$news"></x-news.categories-select>
    <x-form.textarea label="Meta" labelFor="meta" name="meta" value="{{ old('meta') ?? $news->meta ?? '' }}" class="mt-3"></x-form.textarea>
    <x-form.img label="Upload Featured Image" labelFor="featured-img" name="featured_img" src="{{ json_decode($news?->featured_img)->thumbnail ?? null }}" class="mt-3"></x-form.img>
    <x-form.checkbox label="Publish this news" labelFor="is-published" name="is_published" :value="1" :checked="old('is_published') == 1 || (isset($news) && $news->is_published)" class="mt-4"></x-form.checkbox>
    <p class="mt-3">Description</p>
    <div id="editor" class="mt-2 rounded border p-4"></div>
    @error('description')
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
{{--    these hidden fields are being set from editor js on page load or before submission--}}
    <input type="hidden" name="description" value="{{ old('description') ?? $news->description ?? '' }}">
    <input type="hidden" name="uuid" value="{{ old('uuid') ?? (isset($news) && $news->description ? json_decode($news->description)->uuid : '')}}">
    @isset($method)
        <x-inc.dynamic-btn class="mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit">
            <x-icons.pencil-alt class="h-5 w-5 mr-1"></x-icons.pencil-alt> Update News
        </x-inc.dynamic-btn>
    @else
        <x-inc.dynamic-btn class="mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit">
            <x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create News
        </x-inc.dynamic-btn>
    @endisset
</form>

