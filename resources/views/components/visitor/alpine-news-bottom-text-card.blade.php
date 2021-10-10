<div {{ $attributes->merge(['class' => 'relative border shadow hover:shadow-none rounded overflow-hidden drop-shadow-xl transition duration-300']) }}>
    <a :href="`/${news.slug}`">
        <span class="absolute h-full w-full top-0 left-0"></span>
    </a>
    <div>
        <div class="w-full h-40 overflow-hidden">
            <img class="w-full h-full object-cover" :src="news.featured_img" :alt="news.featured_img_alt">
        </div>
        <div class="p-2">
            <h3 class="mb-1 text-xl font-bold" x-text="news.title"></h3>
            <p x-text="news.short_description"></p>
        </div>
        <div class="absolute w-full bottom-0 px-2 py-3 flex justify-between items-center">
            <a :href="`/category/${news.category.slug}`" x-text="news.category.name" class="border-l-2 hover:underline border-primary leading-3 pl-1"></a>
            <p class="text-sm leading-3 text-gray-500" x-text="news.time_ago"></p>
        </div>
        <div class="h-8"></div>
    </div>
</div>
