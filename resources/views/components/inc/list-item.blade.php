@props(['item', 'editLink', 'deleteLink'])
<div class="flex justify-between items-center p-3 border-b">
    <div>
        {{ $slot }}
        <div class="flex items-center gap-2 mt-2">
            <a href="{{ $editLink }}" class="text-sm text-blue-900 font-semibold hover:text-primary transition duration-300">Edit</a>
            <form action="{{ $deleteLink }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="text-sm text-red-900 font-semibold hover:text-red-500 transition duration-300">Delete</button>
            </form>
        </div>
    </div>
    <div>
        <p class="text-gray-700 text-sm">Created: {{ $item->created_at->diffForHumans() }}</p>
        <p class="text-gray-700 text-sm">Last edited: {{ $item->created_at->diffForHumans() }}</p>
    </div>
</div>
