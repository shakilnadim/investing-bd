@props(['category'])
<div x-data="newsData" {{ $attributes->merge(['class' => 'grid sm:grid-col-2 md:grid-cols-3 lg:grid-cols-4 gap-4']) }}>
    <template x-for="news in newsList" :key="news.id">
        <x-visitor.alpine-news-bottom-text-card class="mb-4"></x-visitor.alpine-news-bottom-text-card>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('newsData', () => ({
            newsList: [],

            async init() {
                let news = await axios.get('{{ route('visitor.category.news', ['category' => $category->id]) }}');
                console.log(news);
                this.newsList = news.data.data;
            },
        }))
    })
</script>
