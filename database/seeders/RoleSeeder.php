<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default roles using factory states
        Role::factory()->user()->create([
            'name' => 'user',
            'description' => 'Regular user with basic permissions'
        ]);

        Role::factory()->admin()->create([
            'name' => 'admin',
            'description' => 'Administrator with full system access'
        ]);

        // Alternative approach without factory (direct creation)
        // Role::create([
        //     'name' => 'user',
        //     'description' => 'Regular user with basic permissions'
        // ]);
        
        // Role::create([
        //     'name' => 'admin',
        //     'description' => 'Administrator with full system access'
        // ]);
    }
}
