<?php

namespace Database\Seeders;

use App\Models\ProgramPage;
use Illuminate\Database\Seeder;

class ProgramPageSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        ProgramPage::truncate();

        $programPages = [
            [
                'title' => 'Astha Shishugruha',
                'slug' => 'astha-shishugruha',
                'category' => 'adoption',
                'category_icon' => 'Heart',
                'tagline' => 'Specialised Adoption Agency',
                'hero_alt' => 'Children playing at Astha Shishugruha adoption home',
                'location' => 'Umroli, Palghar',
                'address' => 'Plot No. 12, Near Railway Station, Umroli, Palghar, Maharashtra',
                'registration_number' => 'JJ Act 2015 - PAL-9/SAA/2024/504',
                'registration_authority' => 'Juvenile Justice Board, Palghar',
                'hero_stats' => json_encode([
                    ['value' => '0-6', 'label' => 'Age Group'],
                    ['value' => 'Institutional', 'label' => 'Care Type'],
                    ['value' => 'CARA 2022', 'label' => 'Compliant'],
                    ['value' => '24/7', 'label' => 'Care'],
                ]),
                'statistics' => json_encode([
                    ['value' => '50+', 'label' => 'Children Cared'],
                    ['value' => '30+', 'label' => 'Successful Adoptions'],
                    ['value' => '100%', 'label' => 'Follow-up Rate'],
                    ['value' => '4.8', 'label' => 'Avg. Rating'],
                ]),
                'services' => json_encode([
                    [
                        'title' => 'Child Care & Protection',
                        'description' => '24/7 residential care and protection services',
                        'details' => 'Round-the-clock care by trained staff in a safe environment',
                        'icon' => 'Child',
                        'color' => 'blue',
                        'eligibility' => 'Children aged 0-6 years'
                    ],
                ]),
                'required_documents' => json_encode([
                    'Application Form',
                    'Identity Proof',
                    'Address Proof',
                    'Medical Certificate'
                ]),
                'contact_phone' => '+91 9876543210',
                'contact_email' => 'adoption@ssbss.org',
                'contact_hours' => 'Mon-Sat, 10AM-6PM',
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($programPages as $programPage) {
            ProgramPage::create($programPage);
        }
    }
}