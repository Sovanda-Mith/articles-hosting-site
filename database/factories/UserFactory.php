<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'occupation' => "Developer",
            'gender' => fake()->randomElement(['male', 'female']),
            'remember_token' => Str::random(10),
            'created_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
            'bio' => fake()->text(100),
            'pf_image' => env('APP_URL', 'http://localhost:3000/') . 'resources/assets/images/default_pf.jpg',
            'role_id' => 1, // Default to user role (assuming user role has id 1)
            'address_line' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'phone_number' => $this->faker->phoneNumber(),
            'dob' => $this->faker->date('Y-m-d', '-18 years'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
