<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // // get user roleID
      //   $userRole = Role::where('name', 'user')->first();
      //   $adminRole = Role::where('name', 'admin')->first();

        User::factory()->count(50)->create();
    }
}
