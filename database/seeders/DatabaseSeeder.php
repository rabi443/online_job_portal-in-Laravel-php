<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->createMany([
        //     [
        //         'name' => 'Rabin Chaudhary',
        //         'email' => 'rabinchy54321@gmail.com',
        //         'password' => bcrypt('password'),
        //     ],
        //     [
        //         'name' => 'John Doe',
        //         'email' => 'rc2583463@gmail.com',
        //         'password' => bcrypt('password123'),
        //     ],
        // ]);

          // Call additional seeders
          $this->call([
            // UsersTableSeeder::class,
            JobCategorySeeder::class,
            JobTitleSeeder::class,
            SkillSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
