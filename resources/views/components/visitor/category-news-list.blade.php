@props(['category'])
<div x-data="newsData">
    <template x-for="news in newsList" :key="news.id">
        <h2 x-text="news.title"></h2>
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
