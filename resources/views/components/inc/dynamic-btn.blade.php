@props(['type' => ''])
<button  {{ $attributes->merge(['class' => 'flex items-center px-2 py-1 border border-transparent rounded-md font-semibold text-xs tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150', 'type' => $type]) }}>
    {{ $slot }}
</button>
