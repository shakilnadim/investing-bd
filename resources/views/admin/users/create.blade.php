<x-app-layout>
    <x-slot name="title">Create New User</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['users' => route('admin.users'), 'Create' => route('admin.users.create')]"></x-inc.breadcrumb>
    </x-slot>

    <x-users.form action="{{ route('admin.users.store') }}" :parentCategories="$parentCategories"></x-users.form>
</x-app-layout>
