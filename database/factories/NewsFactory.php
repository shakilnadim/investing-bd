<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->text(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => $this->faker->numberBetween(1, 15),
            'user_id' => 1,
            'is_published' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'start_date' => $this->faker->dateTime('now'),
            'end_time' => $this->faker->dateTime(),
            'description' => '',
            'featured_img' => '',
        ];
    }
}
