@props(['labelFor', 'name', 'label', 'src'])
<div {{ $attributes }} x-data="imageUpload">
    <label for="{{ $labelFor }}">{{ $label }}</label>
    <img x-ref="image" src="{{ $src ? Storage::url($src) : '' }}" alt="" class="w-40">
    <input type="file" id="{{ $labelFor }}" name="{{ $name }}" class="w-full rounded border border-gray-300 shadow-sm mt-1 p-1" accept=".jpg,.jpeg,.png" @change="displayImage">
    @error($name)
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageUpload', () => ({
            displayImage(e){
                this.$refs.image.src = URL.createObjectURL(e.target.files[0]);
            }
        }));
    })
</script>
