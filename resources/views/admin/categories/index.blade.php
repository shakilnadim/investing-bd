<x-app-layout>
    <x-slot name="title">Categories</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Categories' => route('admin.categories')]">
            <x-inc.btn-link link="{{ route('admin.categories.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new category</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-categories.table :categories="$categories"></x-categories.table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

</x-app-layout>
