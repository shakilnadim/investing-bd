@props(['news', 'showShortDescription' => false, 'featuredImgSize'])
<div {{ $attributes->merge(['class' => 'relative text-white']) }}>
    <div class="w-full h-full">
        <img class="w-full h-full object-cover object-center" src="{{ json_decode($news->featured_img)->{$featuredImgSize} }}" alt="{{ $news->featured_img_alt }}">
    </div>

    <div class="absolute w-full h-full left-0 top-0 bg-gradient-to-t from-grayOverlay-900 to-grayOverlay-300 hover:from-grayOverlay-900-lighter transition duration-300">
        <a href="{{ route('visitor.news', ['news' => $news->slug]) }}"><span class="absolute w-full h-full left-0 top-0"></span></a>

        <div class="absolute w-full left-0 bottom-7 p-3">
            <h3>
                <a class="block text-xl font-bold" href="{{ route('visitor.news', ['news' => $news->slug]) }}">{{ $news->title }}</a>
            </h3>
            @if($showShortDescription)
                <p><a class="block text-gray-200 mt-1" href="{{ route('visitor.news', ['news' => $news->slug]) }}">{{ $news->short_description }}</a></p>
            @endif
            <x-visitor.inc.category name="{{ $news->category->name }}" link="{{ route('visitor.category', ['category' => $news->category->slug]) }}"></x-visitor.inc.category>
        </div>
    </div>
</div>
