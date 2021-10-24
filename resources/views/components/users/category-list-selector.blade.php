<div {{ $attributes }} x-data="categorySelector">
    <p>Category Permissions</p>
    <div class="flex flex-wrap gap-2 mt-1">
        @foreach($getParentCategories as $category)
            <div :class="permittedCategories['{{ $category->id }}'] ? 'bg-green-200 border-green-600' : 'bg-red-200 border-red-600'" class="border rounded p-2 cursor-pointer transition duration-300" @click="togglePermittedCategories('{{ $category->id }}')">
                {{ $category->name }}
            </div>
        @endforeach
    </div>
    <input name="categories" type="hidden" x-model="categoryString">
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('categorySelector', () => ({
            permittedCategories : {},
            categoryString: '',

            togglePermittedCategories(id) {
                this.permittedCategories[id] = this.permittedCategories[id] ? !this.permittedCategories[id] : true;
                this.categoryString = JSON.stringify(this.permittedCategories);
            }
        }))
    })
</script>
