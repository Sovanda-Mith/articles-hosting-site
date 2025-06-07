<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(
            [
                [
                  'name' => 'General Knowledge',
                  'description' => 'General Knowledge',
                ],
                [
                  'name' => 'History',
                  'description' => 'History',
                ],
                [
                  'name' => 'Geography',
                  'description' => 'Geography',
                ],
                [
                  'name' => 'Politics',
                  'description' => 'Politics',
                ],
                [
                  'name' => 'Sports',
                  'description' => 'Sports',
                ],
                [
                  'name' => 'Entertainment',
                  'description' => 'Entertainment',
                ],
                [
                  'name' => 'Science',
                  'description' => 'Science',
                ],
                [
                  'name' => 'Technology',
                  'description' => 'Technology',
                ],
                [
                  'name' => 'Business',
                  'description' => 'Business',
                ],
                [
                  'name' => 'Health',
                  'description' => 'Health',
                ],
                [
                  'name' => 'Art',
                  'description' => 'Art',
                ],
                [
                  'name' => 'Music',
                  'description' => 'Music',
                ],
                [
                  'name' => 'Religion',
                  'description' => 'Religion',
                ],
                [
                  'name' => 'Philosophy',
                  'description' => 'Philosophy',
                ],
                [
                  'name' => 'Mythology',
                  'description' => 'Mythology',
                ],
                [
                  'name' => 'Culture',
                  'description' => 'Culture',
                ],
                [
                  'name' => 'Language',
                  'description' => 'Language',
                ],
                [
                  'name' => 'Mathematics',
                  'description' => 'Mathematics',
                ],
                [
                  'name' => 'Design',
                  'description' => 'Design',
                ],
                [
                    'name' => 'Food',
                    'description' => 'Food',
                ],
                [
                    'name' => 'Travel',
                    'description' => 'Travel',
                ],
                [
                  'name' => 'Lifestyle',
                  'description' => 'Lifestyle',
                ]
            ]
        );
    }
}
