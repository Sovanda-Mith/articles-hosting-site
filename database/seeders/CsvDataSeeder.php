<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CsvDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting CSV data import...');

        // Disable foreign key checks
        DB::statement('SET foreign_key_checks = 0');

        // Import in order to respect foreign key dependencies
        // 1. Users first (no dependencies)
        $this->importCsv('users', storage_path('app/csv/users.csv'));
        
        // 2. Categories (no dependencies)
        $this->importCsv('categories', storage_path('app/csv/categories.csv'));
        
        // 3. Articles (depends on users)
        $this->importCsv('articles', storage_path('app/csv/articles.csv'));
        
        // 4. Article Categories (depends on articles and categories)
        $this->importCsv('article_categories', storage_path('app/csv/article_categories.csv'));
        
        // 5. Article Likes (depends on users and articles)
        $this->importCsv('article_likes', storage_path('app/csv/article_likes.csv'));
        
        // 6. Article Comments (depends on users and articles)
        $this->importCsv('article_comments', storage_path('app/csv/article_comments.csv'));

        // Re-enable foreign key checks
        DB::statement('SET foreign_key_checks = 1');

        $this->command->info('CSV data import completed!');
    }

    private function importCsv(string $table, string $csvFile): void
    {
        if (!File::exists($csvFile)) {
            $this->command->error("CSV file not found: {$csvFile}");
            return;
        }

        $this->command->info("Importing {$table}...");

        $data = array_map('str_getcsv', file($csvFile));
        $header = array_shift($data); // Remove header row

        // Clear existing data (now safe with foreign keys disabled)
        DB::table($table)->truncate();

        foreach ($data as $row) {
            $record = array_combine($header, $row);
            
            // Convert empty strings to null for nullable fields
            foreach ($record as $key => $value) {
                if ($value === '' || $value === 'NULL') {
                    $record[$key] = null;
                }
            }

            try {
                DB::table($table)->insert($record);
            } catch (\Exception $e) {
                $this->command->error("Error inserting record into {$table}: " . $e->getMessage());
                $this->command->error("Record data: " . json_encode($record));
            }
        }

        $count = count($data);
        $this->command->info("Imported {$count} records into {$table}");
    }
}
