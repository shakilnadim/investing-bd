<header>
    <div class="md:container mx-auto md:max-h-24 overflow-hidden md:flex items-end justify-between">
        <a href="/">
            <img class="mx-auto" src="{{ asset('images/logo.jpeg') }}" alt="investing bd">
        </a>
        <div class="relative max-h-24">
            <img class="max-w-full max-h-24 mx-auto" src="{{ Storage::url('biggapon/Media_Hub_Web_Banner4.jpg') }}" alt="">
            <a target="_blank" href="https://youtube.com"><span class="absolute w-full h-full top-0 left-0"></span></a>
        </div>
    </div>

    <nav class="bg-gray-900">
        <ul class="md:container mx-auto md:flex items-center justify-between gap-1">
            @foreach($navItems as $item)
                <li><a class="block px-2 pt-4 pb-2 border-b-4 hover:border-primary hover:text-white transition duration-300 font-semi-bold {{ \Illuminate\Support\Facades\Request::url() == route('visitor.category', ['category' => $item->slug]) ? 'border-primary text-white' : 'border-transparent text-gray-300' }}" href="{{ route('visitor.category', ['category' => $item->slug]) }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>

