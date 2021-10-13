<x-VisitorLayout :category="$category">
    <x-slot name="title"> {{ $category->name }} | Investing BD</x-slot>
    <x-slot name="links">

    </x-slot>

    <div class="grid grid-cols-4 my-4 gap-4">
        <main class="col-span-4 sm:col-span-3">
            <x-visitor.category-news-list :category="$category"></x-visitor.category-news-list>
        </main>
        <aside class="col-span-4 sm:col-span-1">
            <x-visitor.sidebar></x-visitor.sidebar>
        </aside>
    </div>
</x-VisitorLayout>
