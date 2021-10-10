@props(['category'])
<div x-data="newsData" {{ $attributes }}>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <template x-for="news in newsList" :key="news.id">
            <x-visitor.alpine-news-bottom-text-card></x-visitor.alpine-news-bottom-text-card>
        </template>
    </div>
    <template x-if="link">
        <div x-intersect:enter="fetchNews"></div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('newsData', () => ({
            newsList: [],
            link: '{{ route('visitor.category.news', ['category' => $category->id]) }}',

            async fetchNews() {
                let news = await axios.get(this.link);
                this.newsList.push(...news.data.data);
                this.link = news.data.links.next;
                // console.log(this.newsList);
            },
        }))
    })
</script>
