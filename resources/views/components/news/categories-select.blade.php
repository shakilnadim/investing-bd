@props(['categories'])
<div {{ $attributes->merge(['class' => "sm:grid grid-cols-2 gap-2 mt-3"]) }}  x-data="categorySelect">
    <div>
        <label for="parent-category">Parent Category</label>
        <select class="w-full rounded border-gray-300 shadow-sm mt-1" name="parent_category" id="parent-category" x-model="selectedCategory" @change="parentChanged()">
            @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-3 sm:mt-0">
        <label for="sub-category">Sub Category</label>
        <select class="w-full rounded border-gray-300 shadow-sm mt-1" name="sub_category" id="sub-category" x-model="selectedSubCategory">
            <template x-for="category in subCategories" :key="category.id">
                <option :value="category.id" x-text="category.name" :selected="category.id == selectedSubCategory"></option>
            </template>
        </select>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('categorySelect', () => ({
            categories: @json($categories),
            selectedCategory: '{{ old('parent_category') ?? '' }}',
            subCategories: [{id: '', name: 'Select Sub Category'}],
            selectedSubCategory: '{{ old('sub_category') ?? '' }}',
            parentChanged(){
                this.setSubCategories(this.selectedCategory);
            },

            setSubCategories(parentId){
                this.subCategories = [{id: '', name: 'Select Sub Category'}];
                this.categories.forEach((category) => {
                    if(parentId == category.id){
                        this.subCategories.push(...category.published_child_categories);
                        return;
                    }
                });
            },

            init() {
                if (this.selectedCategory !== '') {
                    this.setSubCategories(this.selectedCategory);
                }
            }
        }))
    })
</script>
