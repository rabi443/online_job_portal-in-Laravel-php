<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class JobTitleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JobCategory;

class JobTitleSeeder extends Seeder
{
    public function run(): void
    {
        $jobTitles = [
            'Technology & IT' => [
                'Software Developer', 'Web Developer', 'Mobile App Developer', 'Data Analyst',
                'UI/UX Designer', 'IT Support Specialist', 'DevOps Engineer', 'Cybersecurity Analyst',
                'Machine Learning Engineer', 'Cloud Architect',
            ],
            'Healthcare & Medicine' => [
                'Doctor', 'Nurse', 'Pharmacist', 'Lab Technician', 'Radiologist', 'Surgeon',
                'Psychologist', 'Dentist', 'Physical Therapist', 'Medical Assistant',
            ],
            'Marketing & Sales' => [
                'Digital Marketer', 'SEO Specialist', 'Social Media Manager', 'Sales Executive',
                'Marketing Manager', 'Content Strategist', 'Copywriter', 'Account Executive',
                'Brand Manager', 'Business Development Manager',
            ],
            'Education & Training' => [
                'Teacher', 'Lecturer', 'Tutor', 'Instructional Designer', 'Academic Advisor',
                'Curriculum Developer', 'Principal', 'Education Consultant', 'Training Specialist',
                'Online Course Creator',
            ],
            'Skilled Trades & Labor' => [
                'Electrician', 'Plumber', 'Welder', 'Carpenter', 'HVAC Technician',
                'Construction Worker', 'Machinist', 'Mechanic', 'Roofer', 'Painter',
            ],
            'Business & Management' => [
                'Business Analyst', 'Project Manager', 'Product Manager', 'Operations Manager',
                'Strategy Consultant', 'CEO', 'COO', 'Executive Assistant', 'Management Consultant',
                'Scrum Master',
            ],
            'Finance & Accounting' => [
                'Accountant', 'Auditor', 'Financial Analyst', 'Tax Consultant', 'Bookkeeper',
                'CFO', 'Investment Banker', 'Risk Analyst', 'Payroll Specialist', 'Controller',
            ],
            'Design & Creative' => [
                'Graphic Designer', 'Animator', 'Interior Designer', 'Art Director',
                'Creative Director', 'Industrial Designer', 'Fashion Designer', 'Illustrator',
                '3D Modeler', 'Photographer',
            ],
            'Writing & Content' => [
                'Content Writer', 'Copywriter', 'Technical Writer', 'Editor', 'Proofreader',
                'Blogger', 'Journalist', 'Screenwriter', 'Grant Writer', 'Ghostwriter',
            ],
            'Legal & Law' => [
                'Lawyer', 'Paralegal', 'Legal Assistant', 'Compliance Officer', 'Legal Advisor',
                'Judge', 'Legal Secretary', 'Court Reporter', 'Contract Manager',
                'Litigation Support Specialist',
            ],
            'Science & Research' => [
                'Research Scientist', 'Biologist', 'Chemist', 'Physicist', 'Environmental Scientist',
                'Lab Technician', 'Clinical Researcher', 'Astronomer', 'Geologist', 'Mathematician',
            ],
            'Admin & Office Support' => [
                'Receptionist', 'Administrative Assistant', 'Office Manager', 'Data Entry Clerk',
                'Executive Assistant', 'Front Desk Officer', 'Clerical Assistant', 'Office Clerk',
                'Virtual Assistant', 'Records Manager',
            ],
            'Logistics & Transportation' => [
                'Driver', 'Logistics Coordinator', 'Warehouse Manager', 'Supply Chain Analyst',
                'Fleet Manager', 'Dispatcher', 'Forklift Operator', 'Transport Manager',
                'Inventory Control Specialist', 'Delivery Assistant',
            ],
            'Customer Service' => [
                'Customer Service Representative', 'Call Center Agent', 'Help Desk Support',
                'Client Success Manager', 'Technical Support Agent', 'Customer Care Specialist',
                'Customer Support Engineer', 'Live Chat Agent', 'Account Support Representative',
                'Customer Experience Manager',
            ],
            'Retail & E-commerce' => [
                'Cashier', 'Store Manager', 'Sales Associate', 'Inventory Clerk',
                'E-commerce Specialist', 'Retail Buyer', 'Visual Merchandiser',
                'Online Sales Manager', 'Product Lister', 'Warehouse Packer',
            ],
            'Food & Hospitality' => [
                'Chef', 'Cook', 'Waiter', 'Barista', 'Hotel Receptionist', 'Housekeeper',
                'Bartender', 'Catering Manager', 'Sous Chef', 'Front Desk Clerk',
            ],
            'NGO & Social Work' => [
                'Social Worker', 'Program Coordinator', 'Community Outreach Officer',
                'Fundraising Officer', 'NGO Manager', 'Field Officer', 'Volunteer Coordinator',
                'Development Associate', 'Grant Writer', 'Advocacy Officer',
            ],
            'Media, Arts & Entertainment' => [
                'Actor', 'Musician', 'Video Editor', 'Film Director', 'Photographer', 'DJ',
                'Stage Manager', 'Voice Over Artist', 'Cinematographer', 'Sound Engineer',
            ],
            'Real Estate & Property' => [
                'Real Estate Agent', 'Property Manager', 'Leasing Consultant', 'Appraiser',
                'Real Estate Analyst', 'Home Inspector', 'Title Examiner', 'Land Surveyor',
                'Real Estate Broker', 'Site Supervisor',
            ],
            'Freelance & Remote Jobs' => [
                'Freelance Writer', 'Remote Developer', 'Virtual Assistant', 'Freelance Designer',
                'Remote Support Agent', 'Online Tutor', 'Remote Project Manager',
                'Freelance Editor', 'Remote QA Tester', 'Remote Customer Success Manager',
            ],
        ];

        foreach ($jobTitles as $categoryName => $titles) {
            $category = JobCategory::where('job_category', $categoryName)->first();

            if (!$category) continue;

            foreach ($titles as $title) {
                DB::table('job_title')->insert([
                    'job_title' => $title,
                    'category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
