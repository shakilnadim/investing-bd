<div {{ $attributes->merge(['class' => 'grid grid-cols-2 gap-4']) }}>
    <x-visitor.news-top-text-card class="h-96" :news="$featuredNewsList->first()" :showShortDescription="true" featuredImgSize="{{ \App\Consts\Image::MEDIUM }}"></x-visitor.news-top-text-card>

    <div class="grid grid-cols-2 gap-2">
        @foreach($restOfFeaturedNews as $featuredNews)
            <x-visitor.news-top-text-card class="h-50" :news="$featuredNews" featuredImgSize="{{ \App\Consts\Image::THUMBNAIL }}"></x-visitor.news-top-text-card>
        @endforeach
    </div>
</div>
