@props(['category'])
<div x-data="newsData" {{ $attributes }}>
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
                this.newsList = news.data.news.data;
                console.log(this.newsList);
            },
        }))
    })
</script>
