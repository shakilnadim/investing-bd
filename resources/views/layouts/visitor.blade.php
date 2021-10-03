<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="/favicon.jpeg"/>

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.2/dist/cdn.min.js"></script>
    {{ $links ?? '' }}
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    <x-Visitor.Nav :category="$category"></x-Visitor.Nav>
    @if($showSubNav())
        <x-visitor.sub-nav :category="$category" :parentCategory="$parentCategory"></x-visitor.sub-nav>
    @endif

    <div class="md:container mx-auto">
        {{ $slot }}
    </div>
</div>
</body>
</html>
