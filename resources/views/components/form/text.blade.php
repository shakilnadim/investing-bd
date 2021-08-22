@props(['name', 'value' => '', 'placeholder' => '', 'label', 'labelFor', 'required' => false])
<div {{ $attributes }}>
    <label for="{{ $labelFor }}">{{ $label }}</label>
    <input
        type="text"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $labelFor ? "id=$labelFor" : '' }}
        class="w-full rounded border-gray-300 shadow-sm mt-1"
        {{ $required ? 'required' : '' }}
        value="{{ $value }}"
    >
    @error($name)
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
</div>
