@props(['category'])
<div {{ $attributes }}>
    @if(count($category->news) > 0)
        <a href="{{ route('visitor.category', [$category->slug]) }}" class="inline-block border-l-4 border-primary leading-5 pl-1 text-gray-700 text-2xl font-bold hover:text-gray-900 transition duration-300">{{ $category->name }}</a>

        <div class="mt-2 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($category->news as $news)
                <x-visitor.news-bottom-text-card :news="$news"></x-visitor.news-bottom-text-card>
            @endforeach
        </div>
    @endif
</div>
