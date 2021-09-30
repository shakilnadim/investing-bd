@props(['category', 'parentCategory'])
<div class="bg-primary py-2.5">
    <div class="container mx-auto">
        <div class="pb-2">
            <a class="text-3xl font-bold" href="{{ route('visitor.category', ['category' => $parentCategory->slug]) }}">{{ $parentCategory->name }}</a>
        </div>
        <div class="flex gap-4">
            @foreach($parentCategory->publishedChildCategories as $childCategory)
                <a href="{{ route('visitor.category', ['category' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
            @endforeach
        </div>
    </div>
</div>
