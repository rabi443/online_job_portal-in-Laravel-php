<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'bimhdc@gmail.com',
            'contact_number' => '9811349989',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
