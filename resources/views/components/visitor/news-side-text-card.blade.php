<div {{ $attributes }}>
    <a :href="`/${news.slug}`">
        <div class="flex gap-4 max-w-{500px}">
            <div class="w-80 overflow-hidden">
                <img class="object-cover" :src="JSON.parse(news.featured_img).{{ \App\Consts\Image::THUMBNAIL }}" :alt="news.featured_img_alt">
            </div>
            <div>
                <h3 class="mb-1" x-text="news.title"></h3>
                <p x-text="news.short_description"></p>
            </div>
        </div>
    </a>
</div>
