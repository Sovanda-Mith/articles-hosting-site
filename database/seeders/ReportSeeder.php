<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use App\Models\Article;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id');      // Get all user IDs
        $articles = Article::pluck('article_id'); // Get all article IDs

        // Create 50 fake reports
        for ($i = 0; $i < 50; $i++) {
            Report::create([
                'reporter_id' => $users->random(),
                'article_id' => $articles->random(),
                'reason' => fake()->sentence(),
            ]);
        }
    }
}
