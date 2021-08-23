<x-app-layout>
    <x-slot name="title">Create New Category</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Categories' => route('admin.categories'), 'Create' => route('admin.categories.create')]"></x-inc.breadcrumb>
    </x-slot>

    <x-categories.form action="{{ route('admin.categories.store') }}" :parentCats="$parentCats"></x-categories.form>
</x-app-layout>
