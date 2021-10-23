@props(['users'])
<div x-data="confirmationData">
    <x-inc.table :columns="['Name', 'email', 'role', 'Actions']">
        @foreach($users as $user)
            <tr>
                <td class="p-3 text-sm">{{ $user->name }}</td>
                <td class="p-3 text-sm">{{ $user->email }}</td>
                <td class="p-3 text-sm">{{ $user->role }}</td>
                <td class="p-3 text-sm flex items-center gap-2">
                    <x-inc.dynamic-btn-link link="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="bg-blue-200 hover:bg-blue-400 text-blue-900">
                        Edit
                    </x-inc.dynamic-btn-link>

                    <x-inc.dynamic-btn class="text-red-900 bg-red-200 hover:bg-red-400" @click="deleteConfirmation('category', '{{ route('admin.users.delete', ['user' => $user->id]) }}')">Delete</x-inc.dynamic-btn>
                </td>
            </tr>
        @endforeach
    </x-inc.table>

    <template x-if="showConfirmationPopup">
        <x-inc.confirmation-popup></x-inc.confirmation-popup>
    </template>
</div>

