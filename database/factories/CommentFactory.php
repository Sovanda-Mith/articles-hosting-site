<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      static $usersCache = null;
      static $articlesCache = null;
      static $pairedCache = [];
      // Only load these once for better performance
      if ($usersCache === null) {
          $usersCache = User::pluck('id')->toArray();
      }
      if ($articlesCache === null) {
          $articlesCache = Article::pluck('article_id')->toArray();
      }
      // Generate unique combination
      do {
          $userId = $this->faker->randomElement($usersCache);
          $articleId = $this->faker->randomElement($articlesCache);
          $key = $userId . '-' . $articleId;
      } while (isset($pairedCache[$key]));
      // Mark this combination as used (using array keys for faster lookup)
      $pairedCache[$key] = true;

      return [
          'user_id' => $userId,
          'article_id' => $articleId,
          'content' => $this->faker->text(200),
          'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
          'updated_at' => function (array $attributes) {
              return $attributes['created_at'];
          },
      ];
    }
}
