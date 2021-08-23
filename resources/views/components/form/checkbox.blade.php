@props(['name', 'label', 'labelFor', 'checked' => false, 'value' => ''])
<div {{ $attributes }}>
    <label for="{{ $labelFor }}" class="inline-flex items-center">
        <input
            id="{{ $labelFor }}"
            type="checkbox"
            class="rounded border-gray-300 text-blue-700 shadow-sm focus:border-blue-700 focus:ring focus:ring-blue-700 focus:ring-opacity-50"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
        >
        <span class="ml-2 text-sm text-gray-600">{{ $label }}</span>
        @error($name)
        <div class="text-red-800 text-sm">{{ $message }}</div>
        @enderror
    </label>
</div>
