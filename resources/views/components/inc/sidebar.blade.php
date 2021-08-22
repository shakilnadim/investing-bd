<div {{ $attributes }}>
    <ul>
        @foreach($items as $item)
            <li>
                <a class="text-lg block p-2 flex items-center gap-x-2 text-white font-semibold xl:hover:bg-gray-800 transition duration-300 ease-in-out {{ $isActive($item['link']) ? 'bg-gray-800' : '' }}" href="{{ route($item['link']) }}">
                    {!! $item['icon'] !!} {{ $item['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
