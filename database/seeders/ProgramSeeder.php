<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Astha Shishugruha',
                'subtitle' => 'Specialised Adoption Agency',
                'description' => 'Providing loving, permanent homes for orphans, abandoned, and surrendered children through CARA-regulated adoption processes. Our agency follows strict guidelines to ensure every child finds the right family.',
                'icon' => 'Heart',
                'image_alt' => 'Child playing at Astha Shishugruha adoption home',
                'features' => [
                    ['feature' => 'CARA 2022 Regulations Compliant'],
                    ['feature' => 'Non-Granted Operation'],
                    ['feature' => 'JJ Act 2015 Section 41 Registered'],
                    ['feature' => 'Comprehensive Child Care'],
                ],
                'stats' => [
                    ['label' => 'Age Group', 'value' => '0-6 Years'],
                    ['label' => 'Care Type', 'value' => 'Institutional'],
                ],
                'cta_link' => 'astha-shishugruha',
                'sort_order' => 1,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'title' => 'Astha Open Shelter',
                'subtitle' => 'For Boys in Crisis',
                'description' => 'A safe haven providing immediate shelter, medical care, and family reunification for street children, runaways, and children in need of care and protection.',
                'icon' => 'Home',
                'image_alt' => 'Children at Astha shelter participating in activities',
                'features' => [
                    ['feature' => '24/7 Emergency Shelter'],
                    ['feature' => 'Family Tracing & Reunification'],
                    ['feature' => 'Medical & Psychological Care'],
                    ['feature' => 'Education Support'],
                ],
                'stats' => [
                    ['label' => 'Children Reunited', 'value' => '175+'],
                    ['label' => 'Capacity', 'value' => '20 Beds'],
                ],
                'cta_link' => 'astha-open-shelter',
                'sort_order' => 2,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'title' => 'Balsnehi Firte Pathak',
                'subtitle' => 'Street Children Outreach',
                'description' => 'Reaching vulnerable children in street situations across Nashik city, providing identity, nutrition, and pathway to rehabilitation and family strengthening.',
                'icon' => 'Users',
                'image_alt' => 'Outreach worker assisting street children',
                'features' => [
                    ['feature' => '15 Hotspots Covered'],
                    ['feature' => 'Identity Documentation'],
                    ['feature' => 'Nutrition & Healthcare'],
                    ['feature' => 'Counseling & Guidance'],
                ],
                'stats' => [
                    ['label' => 'Children Reached', 'value' => '275+'],
                    ['label' => 'Hotspots', 'value' => '15 Locations'],
                ],
                'cta_link' => 'balsnehi-firte-pathak',
                'sort_order' => 3,
                'is_active' => true,
                'featured' => false,
            ],
            [
                'title' => 'Bal Sangopan Yojana',
                'subtitle' => 'Family-Based Welfare',
                'description' => 'Supporting vulnerable children within family settings through financial assistance, ensuring they grow in a loving family environment rather than institutions.',
                'icon' => 'Shield',
                'image_alt' => 'Family receiving support through welfare program',
                'features' => [
                    ['feature' => '₹2,250 Monthly Assistance'],
                    ['feature' => 'Family Strengthening'],
                    ['feature' => 'Regular Follow-ups'],
                    ['feature' => 'Community Integration'],
                ],
                'stats' => [
                    ['label' => 'Families Supported', 'value' => '400+'],
                    ['label' => 'Benefit', 'value' => 'Monthly Stipend'],
                ],
                'cta_link' => 'bal-sangopan-yojana',
                'sort_order' => 4,
                'is_active' => true,
                'featured' => false,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}