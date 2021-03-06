@props(['news'])
<div x-data="confirmationData">
    <x-inc.table :columns="['Title', 'Slug', 'Parent Category', 'Sub Category', 'Status', 'Is Featured', 'Author', 'Actions']">
        @foreach($news as $singleNews)
            <tr>
                <td class="p-3 text-sm">
                    <div class="flex items-center gap-1">
                        <img src="{{ get_img($singleNews->featured_img,\App\Consts\Image::XS) }}" alt="">
                        <p>{{ $singleNews->title }}</p>
                    </div>
                </td>
                <td class="p-3 text-sm">{{ $singleNews->slug }}</td>
                <td class="p-3 text-sm">{{ get_parent_category_name($singleNews) }}</td>
                <td class="p-3 text-sm">{{ get_sub_category_name($singleNews) }}</td>
                <td class="p-3 text-sm">
                    <span class="px-1 rounded-lg {{ $singleNews->is_published ? 'bg-green-100 text-green-900' : 'bg-pink-100 text-pink-900' }}">
                        {{ $singleNews->is_published ? 'Published' : 'Unpublished' }}
                    </span>
                </td>
                <td class="p-3 text-sm">{{ $singleNews->is_featured }}</td>
                <td class="p-3 text-sm">{{ $singleNews->author->name }}</td>
                <td class="p-3 text-sm">
                    <div class="flex items-center gap-2">
                        <x-inc.dynamic-btn-link link="{{ route('admin.news.edit', ['news' => $singleNews->id]) }}" class="bg-blue-200 hover:bg-blue-400 text-blue-900">
                            Edit
                        </x-inc.dynamic-btn-link>

                        @if($singleNews->is_published)
                            <x-inc.dynamic-btn class="justify-center w-20 bg-pink-200 hover:bg-pink-400 text-pink-900" @click="updateStatusConfirmation('news', 'unpublish', '{{ route('admin.news.update.status', [$singleNews->id, 'unpublish']) }}')">Unpublish</x-inc.dynamic-btn>
                        @else
                            <x-inc.dynamic-btn class="justify-center w-20 bg-green-200 hover:bg-green-400 text-green-900" @click="updateStatusConfirmation('news', 'publish', '{{ route('admin.news.update.status', [$singleNews->id, 'publish']) }}')">Publish</x-inc.dynamic-btn>
                        @endif

                        <x-inc.dynamic-btn class="text-red-900 bg-red-200 hover:bg-red-400" @click="deleteConfirmation('news', '{{ route('admin.news.delete', ['news' => $singleNews->id]) }}')">Delete</x-inc.dynamic-btn>
                    </div>

                </td>
            </tr>
        @endforeach
    </x-inc.table>

    <template x-if="showConfirmationPopup">
        <x-inc.confirmation-popup></x-inc.confirmation-popup>
    </template>
</div>
