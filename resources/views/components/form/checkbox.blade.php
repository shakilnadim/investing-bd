@props(['name', 'label', 'labelFor', 'value' => ''])
<div {{ $attributes }}>
    <label for="{{ $labelFor }}" class="inline-flex items-center">
        <input
            id="{{ $labelFor }}"
            type="checkbox"
            class="rounded border-gray-300 text-primary shadow-sm focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-50"
            {{ $model ? 'x-model=' . $model : 'name=' . $name }}
            value="{{ $value }}"
        >
        <span class="ml-2 text-sm text-gray-600">{{ $label }}</span>
        @error($name)
        <div class="text-red-800 text-sm">{{ $message }}</div>
        @enderror
    </label>
</div>
