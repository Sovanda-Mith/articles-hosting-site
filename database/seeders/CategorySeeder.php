<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Category::insert(
            array_map(function($category) use ($faker) {
              return [
                'name' => $category,
                'description' => $category,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
              ];
            }, [
              'General Knowledge', 'History', 'Geography', 'Politics', 'Sports',
              'Entertainment', 'Science', 'Technology', 'Business', 'Health',
              'Art', 'Music', 'Religion', 'Philosophy', 'Mythology',
              'Culture', 'Language', 'Mathematics', 'Design', 'Food',
              'Travel', 'Lifestyle'
            ])
        );
    }
}
