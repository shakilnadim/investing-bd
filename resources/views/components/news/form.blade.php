@props(['news', 'method', 'categories'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'w-full lg:w-4/6 mx-auto mt-5 news-form']) }}>
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <x-form.text label="Title" labelFor="title" name="title" value="{{ old('name') ?? $news->title ?? '' }}"></x-form.text>
    <x-form.text label="Slug" labelFor="slug" name="slug" value="{{ old('slug') ?? $news->slug ?? '' }}" class="mt-3"></x-form.text>
    <x-news.categories-select :categories="$categories"></x-news.categories-select>
    <x-form.textarea label="Meta" labelFor="meta" name="meta" value="{{ old('meta') ?? $news->meta ?? '' }}" class="mt-3"></x-form.textarea>
    <x-form.img label="Upload Featured Image" labelFor="featured-img" name="featured_img" class="mt-3"></x-form.img>
    <p class="mt-3">Description</p>
    <div id="editor" class="mt-2 rounded border p-4"></div>
    <input type="hidden" name="description" value="{{ old('description') ?? $news->description ?? '' }}">
    <x-button class="mt-3"><x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create News</x-button>
</form>

