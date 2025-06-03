<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $skills = [
            'Communication',
            'Teamwork',
            'Problem Solving',
            'Time Management',
            'Adaptability',
            'Critical Thinking',
            'Leadership',
            'Project Management',
            'Customer Service',
            'Sales',
            'Marketing',
            'Accounting',
            'Data Analysis',
            'Graphic Design',
            'Content Writing',
            'SEO',
            'Social Media Management',
            'Web Development',
            'Mobile App Development',
            'UI/UX Design',
            'JavaScript',
            'PHP',
            'Laravel',
            'Python',
            'Java',
            'C#',
            'MySQL',
            'MongoDB',
            'HTML & CSS',
            'DevOps',
            'Cloud Computing',
            'AWS',
            'Docker',
            'Kubernetes',
            'Linux',
            'Machine Learning',
            'Artificial Intelligence',
            'Cybersecurity',
            'Video Editing',
            'Photography',
        ];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
