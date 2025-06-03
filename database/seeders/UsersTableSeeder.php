<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1001,
                'role' => 'employer',
                'password' => Hash::make('password123'),
                'otp' => null,
                'email' => 'rc2583463@gmail.com',
                'email_status' => 'verified',
                'contact_number' => '9811349989',
                'contact_status' => 'verified',
                'remember_token' => Str::random(10),
                'active_status' => 'online',
                'account_status' => 'verified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1002,
                'role' => 'jobseeker',
                'password' => Hash::make('password123'),
                'otp' => '123456',
                'email' => 'rabinchy54321@gmail.com',
                'email_status' => 'not verified',
                'contact_number' => '9816321861',
                'contact_status' => 'not verified',
                'remember_token' => Str::random(10),
                'active_status' => 'offline',
                'account_status' => 'not verified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

