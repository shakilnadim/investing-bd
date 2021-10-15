<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'is_published' => $this->faker->boolean,
            'is_on_primary_nav' => $this->faker->boolean,
            'is_in_home' => $this->faker->boolean,
        ];
    }
}
