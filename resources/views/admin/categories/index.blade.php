<x-app-layout>
    <x-slot name="title">Categories</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Categories' => route('admin.categories')]">
            <x-inc.btn-link link="{{ route('admin.categories.create') }}"><x-icons.add class="h-6 w-6"></x-icons.add> Create new category</x-inc.btn-link>
        </x-inc.breadcrumb>
    </x-slot>

    @foreach($categories as $category)
        <x-inc.list-item :item="$category"
                         editLink="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                         deleteLink="{{ route('admin.categories.delete', ['category' => $category->id]) }}">
            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="text-lg font-semibold hover:text-primary transition duration-300">{{ $category->name }}</a> <span class="p-1 {{ $category->is_published ? 'bg-green-600' : 'bg-red-600' }} text-xs rounded text-white">{{ $category->is_published ? 'Published' : 'Unpublished' }}</span>
        </x-inc.list-item>
    @endforeach

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

</x-app-layout>
