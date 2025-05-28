<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(3, 8)),
            'subtitle' => $this->faker->sentence(rand(5, 15)),
            'content' => $this->faker->paragraphs(rand(3, 7), true),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'view_count' => $this->faker->numberBetween(0, 1000),
            // 'image' => $this->faker->imageUrl(640, 480, 'article', true),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the article is published.
     *
     * @return $this
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
            ];
        });
    }
}
