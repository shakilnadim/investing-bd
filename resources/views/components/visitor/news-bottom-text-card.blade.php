<div {{ $attributes->merge(['class' => 'border rounded overflow-hidden']) }}>
    <a :href="`/${news.slug}`">
        <div class="flex gap-4">
            <div class="w-80 overflow-hidden">
                <img class="object-cover" :src="news.featured_img" :alt="news.featured_img_alt">
            </div>
            <div>
                <h3 class="mb-1 text-xl font-semibold" x-text="news.title"></h3>
                <p x-text="news.short_description"></p>

            </div>
        </div>
    </a>
</div>
