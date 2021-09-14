<x-app-layout>
    <x-slot name="title">News</x-slot>

    <slot name="links">
        <script src="{{ asset('js/confirmationPopup.js') }}"></script>
    </slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['News' => route('admin.news')]">
            <x-inc.btn-link link="{{ route('admin.news.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new news</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-news.table :news="$news"></x-news.table>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</x-app-layout>
