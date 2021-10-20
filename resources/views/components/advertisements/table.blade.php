@props(['advertisements'])
<div x-data="confirmationData">
    <x-inc.table :columns="['Placement', 'Status', 'Actions']">
        @foreach($advertisements as $ad)
            <tr>
                <td class="p-3 text-sm">{{ $ad->placement }}</td>
                <td class="p-3 text-sm">
                    <span class="px-1 rounded-lg {{ $ad->is_published ? 'bg-green-100 text-green-900' : 'bg-pink-100 text-pink-900' }}">
                        {{ $ad->is_published ? 'Published' : 'Unpublished' }}
                    </span>
                </td>
                <td class="p-3 text-sm flex items-center gap-2">
                    <x-inc.dynamic-btn-link link="{{ route('admin.advertisements.edit', ['advertisement' => $ad->id]) }}" class="bg-blue-200 hover:bg-blue-400 text-blue-900">
                        Edit
                    </x-inc.dynamic-btn-link>

                    @if($ad->is_published)
                        <x-inc.dynamic-btn class="justify-center w-20 bg-pink-200 hover:bg-pink-400 text-pink-900" @click="updateStatusConfirmation('ad', 'unpublish', '{{ route('admin.advertisements.update.status', [$ad->id, 'unpublish']) }}')">Unpublish</x-inc.dynamic-btn>
                    @else
                        <x-inc.dynamic-btn class="justify-center w-20 bg-green-200 hover:bg-green-400 text-green-900" @click="updateStatusConfirmation('ad', 'publish', '{{ route('admin.advertisements.update.status', [$ad->id, 'publish']) }}')">Publish</x-inc.dynamic-btn>
                    @endif

                    <x-inc.dynamic-btn class="text-red-900 bg-red-200 hover:bg-red-400" @click="deleteConfirmation('category', '{{ route('admin.advertisements.delete', ['advertisement' => $ad->id]) }}')">Delete</x-inc.dynamic-btn>
                </td>
            </tr>
        @endforeach
    </x-inc.table>

    <template x-if="showConfirmationPopup">
        <x-inc.confirmation-popup></x-inc.confirmation-popup>
    </template>
</div>
