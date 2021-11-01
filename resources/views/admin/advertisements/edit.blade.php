<x-app-layout>
    <x-slot name="title">Edit Advertisement</x-slot>

    <x-slot name="breadcrumb">
        <x-inc.breadcrumb :paths="['Advertisements' => route('admin.advertisements'), 'edit' => route('admin.advertisements.edit', $advertisement->id)]"></x-inc.breadcrumb>
    </x-slot>

    <x-advertisements.form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="put" :advertisement="$advertisement"></x-advertisements.form>
</x-app-layout>
