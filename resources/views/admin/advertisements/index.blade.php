<x-app-layout>
    <x-slot name="title">Advertisements</x-slot>

    <slot name="links">
        <script src="{{ asset('js/confirmationPopup.js') }}"></script>
    </slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Advertisements' => route('admin.advertisements')]"></x-inc.breadcrumb>
    </x-slot>

    <x-advertisements.table :advertisements="$advertisements"></x-advertisements.table>
</x-app-layout>
