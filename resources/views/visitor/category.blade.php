<x-VisitorLayout :category="$category">
    <x-slot name="title"> {{ $category->name }} | Investing BD</x-slot>
    <x-slot name="links">

    </x-slot>

    <x-visitor.category-news-list :category="$category"></x-visitor.category-news-list>
</x-VisitorLayout>
