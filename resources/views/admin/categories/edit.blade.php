<x-app-layout>
    <x-slot name="title">Edit Category</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Categories' => route('admin.categories'), 'edit' => route('admin.categories.edit', $category->id)]">
            <x-inc.btn-link link="{{ route('admin.categories.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new category</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-categories.form action="{{ route('admin.categories.update', $category->id) }}" method="patch" :category="$category" :parentCats="$parentCats"></x-categories.form>
</x-app-layout>
