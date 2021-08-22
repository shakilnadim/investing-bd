@props(['name', 'value' => '', 'placeholder' => '', 'label', 'labelFor', 'required' => false])
<div {{ $attributes }}>
    <label for="{{ $labelFor }}">{{ $label }}</label>
    <textarea
        type="text"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $labelFor ? "id=$labelFor" : '' }}
        class="w-full rounded border-gray-300 shadow-sm mt-1"
        {{ $required ? 'required' : '' }}
    >{{ $value }}</textarea>
    @error($name)
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
</div>
