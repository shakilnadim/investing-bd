@props(['categories'])
<div x-data="confirmationData">
    <x-inc.table :columns="['Name', 'Parent Category', 'Status', 'Created at', 'Last updated at', 'Actions']">
        @foreach($categories as $category)
            <tr>
                <td class="p-3 text-sm">{{ $category->name }}</td>
                <td class="p-3 text-sm">{{ $category->category->name ?? null }}</td>
                <td class="p-3 text-sm">
                    <span class="px-1 rounded-lg {{ $category->is_published ? 'bg-green-100 text-green-900' : 'bg-pink-100 text-pink-900' }}">
                        {{ $category->is_published ? 'Published' : 'Unpublished' }}
                    </span>
                </td>
                <td class="p-3 text-sm">{{ $category->created_at->diffForHumans() }}</td>
                <td class="p-3 text-sm">{{ $category->updated_at->diffForHumans() }}</td>
                <td class="p-3 text-sm flex items-center gap-2">
                    <x-inc.dynamic-btn-link link="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="bg-blue-200 hover:bg-blue-400 text-blue-900">
                        Edit
                    </x-inc.dynamic-btn-link>

                    @if($category->is_published)
                        <x-inc.dynamic-btn class="justify-center w-20 bg-pink-200 hover:bg-pink-400 text-pink-900" @click="updateStatusConfirmation('unpublish', '{{ route('admin.categories.update.status', [$category->id, 'unpublish']) }}')">Unpublish</x-inc.dynamic-btn>
                    @else
                        <x-inc.dynamic-btn class="justify-center w-20 bg-green-200 hover:bg-green-400 text-green-900" @click="updateStatusConfirmation('publish', '{{ route('admin.categories.update.status', [$category->id, 'publish']) }}')">Publish</x-inc.dynamic-btn>
                    @endif

                    <x-inc.dynamic-btn class="text-red-900 bg-red-200 hover:bg-red-400" @click="deleteConfirmation('{{ route('admin.categories.delete', ['category' => $category->id]) }}')">Delete</x-inc.dynamic-btn>
                </td>
            </tr>
        @endforeach
    </x-inc.table>

    <template x-if="showConfirmationPopup">
        <x-inc.confirmation-popup></x-inc.confirmation-popup>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('confirmationData', () => ({
            showConfirmationPopup: false,
            method: null,
            url: null,
            message: null,
            confirmBtnText: null,
            cancelBtnText: null,
            confirmBtnClass: null,
            cancelBtnClass: null,

            updateStatusConfirmation(status, url) {
                this.method = 'put';
                this.url = url;
                this.confirmBtnText = status;
                this.cancelBtnText = 'Cancel';
                this.confirmBtnClass = status==='publish' ? 'bg-green-700 hover:bg-green-500 text-green-100' : 'bg-pink-700 hover:bg-pink-500 text-pink-100';
                this.cancelBtnClass = 'bg-gray-700 hover:bg-gray-500 text-gray-100';
                this.message = `Are you sure you want to ${status} this category?`;
                this.showConfirmationPopup = true;
            },

            deleteConfirmation(url) {
                this.method = 'delete';
                this.url = url;
                this.confirmBtnText = 'Delete';
                this.cancelBtnText = 'Cancel';
                this.confirmBtnClass = 'bg-red-700 hover:bg-red-500 text-red-100';
                this.cancelBtnClass = 'bg-gray-700 hover:bg-gray-500 text-gray-100';
                this.message = 'Are you sure you want to delete this category?'
                this.showConfirmationPopup = true;
            }
        }));
    })
</script>

