<?php

namespace Database\Seeders;

use App\Models\ImpactMetric;
use Illuminate\Database\Seeder;

class ImpactMetricSeeder extends Seeder
{
    public function run(): void
    {
        $metrics = [
            [
                'icon' => 'Users',
                'number' => '275+',
                'label' => 'Street Children Reached',
                'description' => 'Identified and supported through Balsnehi Firte Pathak',
                'image_alt' => 'SSBSS outreach workers interacting with street children',
                'project_link' => 'balsnehi',
                'sort_order' => 1,
                'is_active' => true,
                'show_image' => true,
                'highlight' => false,
            ],
            [
                'icon' => 'Home',
                'number' => '175+',
                'label' => 'Children Reunited',
                'description' => 'Successfully repatriated through Astha Open Shelter Home',
                'image_alt' => 'Happy reunion of child with family at shelter home',
                'project_link' => 'open-shelter',
                'sort_order' => 2,
                'is_active' => true,
                'show_image' => true,
                'highlight' => true,
            ],
            [
                'icon' => 'Heart',
                'number' => '400+',
                'label' => 'Families Supported',
                'description' => 'Through Bal Sangopan Yojana foster care program',
                'image_alt' => 'Family receiving support through welfare program',
                'project_link' => 'foster-care',
                'sort_order' => 3,
                'is_active' => true,
                'show_image' => true,
                'highlight' => false,
            ],
            [
                'icon' => 'Shield',
                'number' => '13+',
                'label' => 'Years of Service',
                'description' => 'Dedicated child protection since 2013',
                'image_alt' => 'SSBSS team celebrating years of service',
                'project_link' => 'about',
                'sort_order' => 4,
                'is_active' => true,
                'show_image' => true,
                'highlight' => false,
            ],
            [
                'icon' => 'MapPin',
                'number' => '3',
                'label' => 'Districts Covered',
                'description' => 'Nashik, Ahilyanagar & Palghar districts of Maharashtra',
                'image_alt' => 'Map showing SSBSS operational districts in Maharashtra',
                'project_link' => 'about#reach',
                'sort_order' => 5,
                'is_active' => true,
                'show_image' => true,
                'highlight' => false,
            ],
            [
                'icon' => 'Award',
                'number' => '15',
                'label' => 'Hotspots Covered',
                'description' => 'Street children intervention locations in Nashik city',
                'image_alt' => 'SSBSS team working in community hotspots',
                'project_link' => 'balsnehi#hotspots',
                'sort_order' => 6,
                'is_active' => true,
                'show_image' => true,
                'highlight' => false,
            ],
        ];

        foreach ($metrics as $metric) {
            ImpactMetric::create($metric);
        }
    }
}