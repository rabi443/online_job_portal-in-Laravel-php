<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology & IT',
            'Healthcare & Medicine',
            'Marketing & Sales',
            'Education & Training',
            'Skilled Trades & Labor',
            'Business & Management',
            'Finance & Accounting',
            'Design & Creative',
            'Writing & Content',
            'Legal & Law',
            'Science & Research',
            'Admin & Office Support',
            'Logistics & Transportation',
            'Customer Service',
            'Retail & E-commerce',
            'Food & Hospitality',
            'NGO & Social Work',
            'Media, Arts & Entertainment',
            'Real Estate & Property',
            'Freelance & Remote Jobs',
        ];

        foreach ($categories as $category) {
            DB::table('job_category')->insert([
                'job_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

