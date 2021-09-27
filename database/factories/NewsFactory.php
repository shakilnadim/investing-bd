<?php

namespace Database\Factories;

use App\Consts\Image;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
        $imgId = $this->faker->numberBetween(1,1000);
        $startDate = Carbon::create(2021, rand(1, 10), 28, 0, 0, 0);
        $endDate = $startDate->addWeeks(rand(1,20));
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => $this->faker->numberBetween(1, 15),
            'user_id' => 1,
            'is_published' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->format('Y-m-d H:i:s'),
            'description' => json_encode([
                'version' => '2.22.2',
                'uuid' => $this->faker->uuid,
                'time' => $this->faker->unixTime,
                'blocks' => [
                    [
                        'id' => uniqid(),
                        'type' => 'paragraph',
                        'data' => [
                            'text' => $this->faker->paragraph
                        ]
                    ]
                ],
            ]),
            'featured_img' => json_encode([
                Image::LARGE => "https://picsum.photos/id/$imgId/1000/600",
                Image::MEDIUM => "https://picsum.photos/id/$imgId/650/450",
                Image::THUMBNAIL => "https://picsum.photos/id/$imgId/250/150",
                Image::XS => "https://picsum.photos/id/$imgId/60/45"
            ]),
        ];
    }
}
