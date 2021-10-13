@props(['news'])
<div>
    <h1 class="text-4xl font-bold">{{ $news->title }}</h1>

    <div class="mt-2">
        <img class="max-w-full mx-auto" src="{{ get_img($news->featured_img, \App\Consts\Image::LARGE) }}" alt="{{ $news->featured_img_alt }}">
    </div>

    <form class="news-form"></form>
    <input type="hidden" name="uuid" value="{{ old('uuid') ?? (isset($news) && $news->description ? json_decode($news->description)->uuid : '')}}">
    <input type="hidden" name="description" value="{{ $news->description }}">
    <div id="editor" class="mt-2 rounded p-4"></div>
</div>
