<div class="flex justify-between items-center p-4 border-b border-gray-200">
    <div class="flex items-center">
        @foreach($paths as $key => $path)
            <x-icons.chevron-right class="text-gray-700 h-4 w-4"></x-icons.chevron-right> <a class="text-sm text-gray-700 hover:text-primary transition duration-100" href="{{ $path }}">{{ $key }}</a>
        @endforeach
    </div>

    {{ $slot }}
</div>
