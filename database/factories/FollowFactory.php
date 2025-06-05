<?php

namespace Database\Factories;

use App\Models\User;
// use App\Models\Follows;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $usersCache = null;
        static $pairedCache = [];

        // Only load users once for better performance
        if ($usersCache === null) {
            $usersCache = User::pluck('id')->toArray();

            // Ensure we have at least 2 users
            if (count($usersCache) < 2) {
                User::factory()->count(10)->create();
                $usersCache = User::pluck('id')->toArray();
            }
        }

        // Generate unique combination
        do {
            $followerId = $this->faker->randomElement($usersCache);
            $followingId = $this->faker->randomElement($usersCache);
            $key = $followerId . '-' . $followingId;
        } while ($followerId === $followingId || isset($pairedCache[$key]));

        // Mark this combination as used (using array keys for faster lookup)
        $pairedCache[$key] = true;

        return [
            'follower_id' => $followerId,
            'following_id' => $followingId,
        ];
    }
}
