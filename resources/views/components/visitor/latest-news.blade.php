<div {{ $attributes }}>
    <h2 class="text-lg font-bold">Latest News</h2>
    @foreach($latestNews as $news)
        <x-visitor.news-bottom-text-card :news="$news" class="mt-4"></x-visitor.news-bottom-text-card>
    @endforeach
</div>
