<x-VisitorLayout :category="$category">
    <x-slot name="title"> {{ $category->name }} | Investing BD</x-slot>
    <x-slot name="links">

    </x-slot>

    <x-visitor.category-news-list class="mt-4" :category="$category"></x-visitor.category-news-list>
</x-VisitorLayout>
