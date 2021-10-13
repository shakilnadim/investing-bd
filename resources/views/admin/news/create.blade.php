<x-app-layout>
    <x-slot name="title">Create New News</x-slot>

    <x-slot name="links">
        <script type="module" src="{{ asset('js/editor.js') }}"></script>
    </x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['News' => route('admin.news'), 'Create' => route('admin.news.create')]"></x-inc.breadcrumb>
    </x-slot>

    <x-news.form action="{{ route('admin.news.store') }}" :categories="$categories"></x-news.form>

</x-app-layout>
