<x-VisitorLayout :category="$category">
    <x-slot name="title"> {{ $category->name }} | Investing BD</x-slot>
    <x-slot name="links">

    </x-slot>

    <div class="grid grid-cols-4 my-4 gap-4">
        <x-visitor.category-news-list class="col-span-4 sm:col-span-3" :category="$category"></x-visitor.category-news-list>
        <aside class="col-span-4 sm:col-span-1">
            <x-Visitor.LatestNews></x-Visitor.LatestNews>
        </aside>
    </div>
</x-VisitorLayout>
