@props(['category'])
<div x-data="newsData" {{ $attributes->merge(['class' => 'grid grid-cols-2 gap-4']) }}>
    <template x-for="news in newsList" :key="news.id">
        <x-visitor.news-side-text-card class="mb-4"></x-visitor.news-side-text-card>
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
                // console.log(this.newsList);
            },
        }))
    })
</script>
