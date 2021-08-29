<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.2/dist/cdn.min.js"></script>
    {{ $scripts ?? '' }}
</head>
<body class="font-sans antialiased">
<div class="grid grid-cols-7 col-span-full">
    <x-inc.sidebar class="w-full col-span-7 md:col-span-1 bg-gray-900"></x-inc.sidebar>

    <div class="min-h-screen bg-gray-100 col-span-7 md:col-span-6">
        <!-- Page Heading -->
        <header class="flex justify-between mx-auto max-w-9xl py-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $header ?? $title ?? config('app.name') }}
            </h2>
            <div class="sm:flex sm:items-center sm:ml-6">
                <x-inc.user-dropdown></x-inc.user-dropdown>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 py-3">
                {{ $breadcrumb ?? '' }}
            </div>

            <div class="py-5">
                <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 relative">
                    @if(Session::get('success') || Session::get('error'))
                    <x-inc.flash-message></x-inc.flash-message>
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
