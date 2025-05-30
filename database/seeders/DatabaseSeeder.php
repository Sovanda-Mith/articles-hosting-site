<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first (they are referenced by users)
        $this->call([
            RoleSeeder::class,
        ]);

        // Get the user role ID
        $userRole = \App\Models\Role::where('name', 'user')->first();
        $adminRole = \App\Models\Role::where('name', 'admin')->first();

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'usernameTest',
            'bio' => 'This is a test bio for user.',
            'gender' => 'male',
            'pf_image' => 'https://via.placeholder.com/150x150.png?text=User1',
            'role_id' => $userRole->role_id,
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'username' => 'usernameTest2',
            'bio' => 'This is a test bio for user 2.',
            'gender' => 'female',
            'pf_image' => 'https://via.placeholder.com/150x150.png?text=User2',
            'role_id' => $userRole->role_id,
        ]);

        // Call ArticleSeeder
        $this->call([
            ArticleSeeder::class,
        ]);
        //Call CategorySeeder
        $this->call([
            CategorySeeder::class,
        ]);
        // Call LikeSeeder
        $this->call([
            LikeSeeder::class,
        ]);
        //Call CommentSeeder
        $this->call([
            CommentSeeder::class,
        ]);

    }
}
