@props(['name', 'value' => '', 'keyField', 'valueField' => 'id', 'label', 'labelFor' => '', 'required' => false, 'options'])
<div {{ $attributes }}>
    <label for="{{ $labelFor }}">{{ $label }}</label>
    <select name="{{ $name }}" {{ $labelFor ? "id=$labelFor" : '' }} class="w-full rounded border-gray-300 shadow-sm mt-1">
        @foreach($options as $option )
            <option value="{{ $option[$valueField] }}" {{ $value == $option[$valueField] ? 'selected' : '' }}>{{ $option[$keyField] }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
</div>
