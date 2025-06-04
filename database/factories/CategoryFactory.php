<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\categories>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      static $namesCache = [];
      static $existingNames = [];

      if($namesCache === null) {
          $namesCache = [];
      }
      do {
          $name = $this->faker->unique()->word();
      } while (isset($existingNames[$name]));

      $namesCache[$name] = true;

      return [
          'name' => $name,
          'description' => $this->faker->sentence(),
          'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
          'updated_at' => function (array $attributes) {
              return $attributes['created_at'];
          },
      ];
    }
}
