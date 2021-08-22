<x-app-layout>
    <x-slot name="title">Create New Category</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Categories' => route('admin.categories'), 'Create' => route('admin.categories.create')]"></x-inc.breadcrumb>
    </x-slot>

    <form action="{{ route('admin.categories.store') }}" method="post" class="w-full lg:w-4/6 mx-auto mt-5">
        @csrf
        <x-form.text label="Category Name" labelFor="category" name="name" value="{{ old('name') }}"></x-form.text>
        <x-form.text label="Slug" labelFor="slug" name="slug" value="{{ old('slug') }}" class="mt-3"></x-form.text>
        <x-form.select label="Parent Category" labelFor="category-id" name="category_id" :options="$parentCats" value="{{ old('category_id') }}" class="mt-3"></x-form.select>
        <x-form.textarea label="Meta" labelFor="meta" name="meta" class="mt-3" value="{{ old('meta') }}"></x-form.textarea>
        <x-button class="mt-3"><x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create Category</x-button>
    </form>
</x-app-layout>
