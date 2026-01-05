<?php

namespace Database\Seeders;

use App\Models\ContactPage;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::query()->delete();

        ContactPage::create([
            'headquarters_title' => 'Headquarters',
            'headquarters_address' => 'A/p Nimgaon paga, Tal. Sangamner, Dist. Ahilyanagar, Maharashtra',
            'headquarters_phone' => '+91 98765 43210',
            'headquarters_email' => 'contact@ssbss.org',
            'headquarters_hours' => 'Monday to Friday: 9:00 AM - 6:00 PM',
            
            'centers' => [
                [
                    'name' => 'Astha Shishugruha (Adoption Agency)',
                    'location' => 'Umroli, Tal.Dist.Palghar',
                    'phone' => '+91 98765 43211',
                    'email' => 'adoption@ssbss.org',
                    'icon' => 'Heart',
                ],
                [
                    'name' => 'Astha Boys Open Shelter Home',
                    'location' => 'Pragati Society, Nanawali Road, B/H Tractor House, Dwarka, Nashik',
                    'phone' => '+91 98765 43212',
                    'email' => 'shelter@ssbss.org',
                    'icon' => 'Building',
                ],
                [
                    'name' => 'Balsnehi Firte Pathak Office',
                    'location' => 'Nashik City Center',
                    'phone' => '+91 98765 43213',
                    'email' => 'outreach@ssbss.org',
                    'icon' => 'Users',
                ],
            ],
            
            'emergency_title' => 'Emergency Contact',
            'child_helpline' => '1098',
            'whatsapp_number' => '+91 98765 43214',
            'emergency_email' => 'emergency@ssbss.org',
            'emergency_note' => 'Available 24/7 for child protection emergencies',
            
            'quick_actions' => [
                [
                    'label' => 'WhatsApp Message',
                    'icon' => 'MessageSquare',
                    'type' => 'whatsapp',
                    'value' => '+919876543214',
                ],
                [
                    'label' => 'Call Emergency',
                    'icon' => 'Phone',
                    'type' => 'phone',
                    'value' => '1098',
                ],
                [
                    'label' => 'Email Inquiry',
                    'icon' => 'Mail',
                    'type' => 'email',
                    'value' => 'contact@ssbss.org',
                ],
            ],
            
            'form_title' => 'Get In Touch',
            'form_description' => 'We\'re here to help. Fill out the form below and our team will respond as soon as possible.',
            'general_form_title' => 'General Inquiry',
            'donation_form_title' => 'Donation Inquiry',
            
            'map_title' => 'Find Us',
            'coordinates' => '19.7515,75.7139',
            'is_active' => true,
        ]);
    }
}