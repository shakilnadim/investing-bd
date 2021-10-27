<x-app-layout>
    <x-slot name="title">Edit User</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['users' => route('admin.users'), 'edit' => route('admin.users.edit', $user->id)]">
            <x-inc.btn-link link="{{ route('admin.users.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new user</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-users.form action="{{ route('admin.users.update', $user->id) }}" method="patch" :user="$user" :permittedCategories="$permittedCategories"></x-users.form>
</x-app-layout>
