<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['user', 'admin', 'moderator', 'editor']),
            'description' => $this->faker->sentence()
        ];
    }

    /**
     * Create an admin role
     */
    public function admin(): static
    {
        return $this->state([
            'name' => 'admin',
            'description' => 'Administrator with full system access'
        ]);
    }

    /**
     * Create a user role
     */
    public function user(): static
    {
        return $this->state([
            'name' => 'user',
            'description' => 'Regular user with basic permissions'
        ]);
    }
}
