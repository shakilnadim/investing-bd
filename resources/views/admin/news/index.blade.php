<x-app-layout>
    <x-slot name="header">News</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['News' => route('admin.news')]">
            <x-inc.btn-link link="{{ route('admin.news.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new news</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>
    @if($errors->any())
        {{ $errors }}
    @endif
    <form action="{{ route('admin.news.uploadImage') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <input type="text" name="uuid">
        <button type="submit">test</button>
    </form>
</x-app-layout>
