<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Astha Shishugruha',
                'subtitle' => 'Specialised Adoption Agency',
                'description' => 'Providing loving homes for orphans, abandoned, and surrendered children through CARA-regulated adoption processes.',
                'icon' => 'Heart',
                'image_alt' => 'Children at Astha Shishugruha adoption home playing together',
                'cta_link' => 'astha-shishugruha',
                'stats' => 'Non-granted • JJ Act 2015 Section 41 • CARA 2022 Compliant',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Astha Boys Open Shelter',
                'subtitle' => 'Safe Haven for Street Children',
                'description' => 'Providing shelter, medical care, and family reunification for street children, runaways, and children in crisis.',
                'icon' => 'Home',
                'image_alt' => 'Boys at Astha shelter participating in educational activities',
                'cta_link' => 'astha-open-shelter',
                'stats' => '175+ Children Reunited • Registered under JJ Act 2015',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Balsnehi Firte Pathak',
                'subtitle' => 'Street Children Outreach',
                'description' => 'Reaching children in street situations across 15 hotspots in Nashik, providing identity, nutrition, and guidance.',
                'icon' => 'Users',
                'image_alt' => 'Outreach workers interacting with street children',
                'cta_link' => 'balsnehi-firte-pathak',
                'stats' => '275+ Children Identified • 15 Hotspots Covered',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Bal Sangopan Yojana',
                'subtitle' => 'Family-Based Child Welfare',
                'description' => 'Supporting vulnerable children within family settings through financial assistance and community strengthening.',
                'icon' => 'Shield',
                'image_alt' => 'Family receiving support through Bal Sangopan Yojana',
                'cta_link' => 'bal-sangopan-yojana',
                'stats' => '400+ Children Supported • ₹2,250 Monthly Assistance',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
