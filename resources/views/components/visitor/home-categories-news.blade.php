<div>
    @foreach($homeCategories as $category)
        <x-visitor.home-category-news class="py-4" :category="$category"></x-visitor.home-category-news>
    @endforeach
</div>
