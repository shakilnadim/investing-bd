<x-app-layout>
    <x-slot name="title">Users</x-slot>

    <slot name="links">
        <script src="{{ asset('js/confirmationPopup.js') }}"></script>
    </slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Users' => route('admin.users')]">
            <x-inc.btn-link link="{{ route('admin.users.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new user</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    <x-users.table :users="$users"></x-users.table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</x-app-layout>
