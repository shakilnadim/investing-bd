@props(['category', 'parentCategory'])
<div class="bg-primary pt-2.5">
    <div class="container max-w-primary mx-auto text-gray-700">
        <div class="pb-2">
            <a class="text-3xl font-bold" href="{{ route('visitor.category', ['category' => $parentCategory->slug]) }}">{{ $parentCategory->name }}</a>
        </div>
        <ul class="flex gap-4">
            @foreach($parentCategory->publishedChildCategories as $childCategory)
                <li>
                    <a class="inline-block px-2 pb-2 border-b-4 hover:border-gray-100 hover:text-gray-100 transition duration-300 font-semi-bold {{ $category->slug === $childCategory->slug ? 'border-gray-100 text-gray-100' : 'border-transparent' }}" href="{{ route('visitor.category', ['category' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
