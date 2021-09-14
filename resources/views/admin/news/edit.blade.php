<x-app-layout>
    <x-slot name="title">Edit News</x-slot>

    <x-slot name="links">
        <script type="module" src="{{ asset('js/editor/editor.js') }}"></script>
    </x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['News' => route('admin.news'), 'edit' => route('admin.news.edit', $news->id)]">
            <x-inc.btn-link link="{{ route('admin.news.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new news</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-news.form action="{{ route('admin.news.update', $news->id) }}" method="patch" :news="$news" :categories="$categories"></x-news.form>
</x-app-layout>
