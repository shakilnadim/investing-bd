<header>
    <div class="container max-w-primary mx-auto md:max-h-24 overflow-hidden md:flex items-end justify-between">
        <a href="/">
            <img class="mx-auto sm:h-16" src="{{ asset('images/logo.jpeg') }}" alt="investing bd">
        </a>
        <div class="relative max-h-24">
            <img class="max-w-full max-h-24 mx-auto" src="{{ \Illuminate\Support\Facades\Storage::url(get_header_ad()->image) }}" alt="">
            <a target="_blank" href="{{ get_header_ad()->link }}"><span class="absolute w-full h-full top-0 left-0"></span></a>
        </div>
    </div>

    <nav class="bg-gray-900">
        <ul class="container max-w-primary mx-auto md:flex md:flex-wrap items-center gap-2">
            @foreach($navItems as $item)
                <li class="self-stretch"><a class="block h-full px-2 pt-4 pb-2 border-b-4 hover:border-primary hover:text-white transition duration-300 font-semi-bold {{ $category !== null && $category->slug === $item->slug ? 'border-primary text-white' : 'border-transparent text-gray-300' }}" href="{{ route('visitor.category', ['category' => $item->slug]) }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>

