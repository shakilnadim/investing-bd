@props(['category', 'method', 'parentCats'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'w-full lg:w-4/6 mx-auto mt-5']) }}>
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <x-form.text label="Category Name" labelFor="category" name="name" value="{{ old('name') ?? $category->name ?? '' }}"></x-form.text>
    <x-form.text label="Slug" labelFor="slug" name="slug" value="{{ old('slug') ?? $category->slug ?? '' }}" class="mt-3"></x-form.text>
    <x-form.select label="Parent Category" labelFor="category-id" name="category_id" :options="$parentCats" value="{{ old('category_id') ?? $category->category_id ?? '' }}" class="mt-3"></x-form.select>
    <x-form.textarea label="Meta" labelFor="meta" name="meta" class="mt-3" value="{{ old('meta') ?? $category->meta ?? '' }}"></x-form.textarea>
    <x-form.checkbox label="Publish this category" labelFor="is-published" name="is_published" :value="1" :checked="old('is_published') == 1 || (isset($category) && $category->is_published)" class="mt-3"></x-form.checkbox>
    @isset($method)
        <x-button class="mt-3"><x-icons.pencil-alt class="h-5 w-5 mr-1"></x-icons.pencil-alt> Update Category</x-button>
    @else
        <x-button class="mt-3"><x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create Category</x-button>
    @endisset
</form>
