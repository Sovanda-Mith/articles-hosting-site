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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'usernameTest',
            'bio' => 'This is a test bio for user.',
            'gender' => 'male',
            'pf_image' => 'https://avatarfiles.alphacoders.com/267/267931.jpg',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'username' => 'usernameTest2',
            'bio' => 'This is a test bio for user 2.',
            'gender' => 'female',
            'pf_image' => 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/8fbd51f4-a7a2-44cb-8f10-43b7e53e8163/dgfhsnj-0f8e161f-4515-470b-b671-6f3052eb36dd.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzhmYmQ1MWY0LWE3YTItNDRjYi04ZjEwLTQzYjdlNTNlODE2M1wvZGdmaHNuai0wZjhlMTYxZi00NTE1LTQ3MGItYjY3MS02ZjMwNTJlYjM2ZGQuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.idnMWrAU-9Muv5XtlA7tLCLzZTTJujPYJk1YO-FnXo4',
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
