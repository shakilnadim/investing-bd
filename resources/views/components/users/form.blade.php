@props(['user', 'method', 'parentCategories'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'w-full lg:w-4/6 mx-auto mt-5', 'autocomplete' => 'off']) }}>
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <x-form.text label="Name" labelFor="name" name="name" value="{{ old('name') ?? $user->name ?? '' }}"></x-form.text>
    <x-form.text type="email" label="Email" labelFor="email" name="email" value="{{ old('email') ?? $user->email ?? '' }}" class="mt-3"></x-form.text>
    <x-form.text type="password" label="Password" labelFor="password" name="password" value="" class="mt-3"></x-form.text>
    @isset($method)
        <x-inc.dynamic-btn class="ml-auto mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit"><x-icons.pencil-alt class="h-5 w-5 mr-1"></x-icons.pencil-alt> Update User</x-inc.dynamic-btn>
    @else
        <x-inc.dynamic-btn class="ml-auto mt-3 ml-auto bg-gray-900 hover:bg-gray-700 text-xs text-white uppercase" type="submit"><x-icons.add-circular class="h-5 w-5 mr-1"></x-icons.add-circular> Create User</x-inc.dynamic-btn>
    @endisset
</form>

{{ $parentCategories }}
