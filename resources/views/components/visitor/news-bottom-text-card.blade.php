@props(['news'])
<div {{ $attributes->merge(['class' => 'relative h-auto border shadow hover:shadow-none rounded overflow-hidden drop-shadow-xl transition duration-300']) }}>
    <a href="{{ route('visitor.news', [$news->slug]) }}">
        <span class="absolute h-full w-full top-0 left-0"></span>
    </a>
    <div>
        <div class="w-full h-40 overflow-hidden">
            <img class="w-full h-full object-cover" src="{{ get_thumbnail($news->featured_img) }}" :alt="{{ $news->featured_img_alt }}">
        </div>
        <div class="p-2">
            <h3 class="mb-1 text-xl font-bold">{{ $news->title }}</h3>
            <p>{{ $news->short_description }}</p>
        </div>
        <div class="absolute w-full bottom-0 px-2 py-3 flex justify-between items-center">
            <a href="{{ route('visitor.category', ['category' => $news->category->slug]) }}" class="border-l-2 hover:underline border-primary leading-3 pl-1">{{ $news->category->name }}</a>
            <div class="flex items-center">
                <x-icons.clock class="h-4 w-4 text-gray-500"></x-icons.clock>
                <p class="text-xs leading-3 text-gray-500">{{ $news->start_time > $news->created_at ? $news->start_time->diffForHumans() : $news->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <div class="h-8"></div>
    </div>
</div>
