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
        $startDate = $endDate = Carbon::create(2021, rand(6, 9), 28);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => $this->faker->numberBetween(1, 15),
            'user_id' => 1,
            'is_published' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $endDate->addWeeks(rand(2,20))->format('Y-m-d H:i:s'),
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
            'short_description' => $this->faker->text(100),
            'featured_img' => json_encode([
                Image::LARGE => "https://picsum.photos/id/$imgId/1000/600",
                Image::MEDIUM => "https://picsum.photos/id/$imgId/760/450",
                Image::THUMBNAIL => "https://picsum.photos/id/$imgId/380/200",
                Image::XS => "https://picsum.photos/id/$imgId/60/45"
            ]),
            'featured_img_alt' => $this->faker->text(10),
        ];
    }
}
