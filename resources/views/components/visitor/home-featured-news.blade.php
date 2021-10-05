<div {{ $attributes->merge(['class' => 'md:grid grid-cols-2 gap-4']) }}>
    <x-visitor.news-top-text-card class="h-72 lg:h-92" :news="$featuredNewsList->first()" :showShortDescription="true" featuredImgSize="{{ \App\Consts\Image::MEDIUM }}"></x-visitor.news-top-text-card>

    <div class="sm:grid grid-cols-2 gap-2 mt-2 md:mt-0">
        @foreach($restOfFeaturedNews as $featuredNews)
            <x-visitor.news-top-text-card class="mt-2 sm:mt-0 h-40 sm:h-34 lg:h-43" :news="$featuredNews" featuredImgSize="{{ \App\Consts\Image::THUMBNAIL }}"></x-visitor.news-top-text-card>
        @endforeach
    </div>
</div>
