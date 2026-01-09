<?php

namespace Database\Seeders;

use App\Models\DonationSetting;
use Illuminate\Database\Seeder;

class DonationSettingSeeder extends Seeder
{
    public function run(): void
    {
        DonationSetting::create([
            'title' => 'Bank Transfer Details',
            'description' => 'Support our work protecting childhoods through direct bank transfer. Choose from our three registered accounts for your convenience.',
            'hero_image' => null,
            'bank_accounts' => [
                [
                    'account_name' => 'SHIVSAHYADRI BAHUDDESHIYA SEVABHAVI SANSTHA',
                    'bank_name' => 'Union Bank Of India',
                    'account_number' => '388301011032335',
                    'ifsc_code' => 'UBIN0575381',
                    'icon' => 'Building',
                ],
                [
                    'account_name' => 'ASTHA BOYS OPEN SHELTER HOME, NASHIK',
                    'bank_name' => 'HDFC Bank',
                    'account_number' => '50200055175204',
                    'ifsc_code' => 'HDFC0002802',
                    'icon' => 'Home',
                ],
                [
                    'account_name' => 'ASTHA SHISHUGRUHA UMROLI',
                    'bank_name' => 'HDFC Bank',
                    'account_number' => '50200109667511',
                    'ifsc_code' => 'HDFC0008622',
                    'icon' => 'Users',
                ],
            ],
            'donation_options' => [
                [
                    'title' => 'One-time Donation',
                    'description' => 'Make a single donation to support our ongoing child protection programs',
                    'amount' => '₹1,000 - Basic care for one child for 15 days',
                    'icon' => 'Banknote',
                    'color' => '#af0c5f',
                ],
                [
                    'title' => 'Monthly Support',
                    'description' => 'Become a monthly donor and provide consistent support for our children',
                    'amount' => '₹2,500 - Monthly education & nutrition for one child',
                    'icon' => 'Calendar',
                    'color' => '#1e7a35',
                ],
                [
                    'title' => 'Child Sponsorship',
                    'description' => 'Sponsor a specific child\'s complete care and development',
                    'amount' => '₹5,000 - Full monthly care for one child',
                    'icon' => 'Shield',
                    'color' => '#35336e',
                ],
            ],
            'certifications' => [
                [
                    'title' => '80G Certified',
                    'description' => 'Tax exemption under section 80G',
                    'icon' => 'FileText',
                    'color' => '#1e7a35',
                ],
                [
                    'title' => '12A Registered',
                    'description' => 'Income tax exemption certificate',
                    'icon' => 'Shield',
                    'color' => '#5d9361',
                ],
                [
                    'title' => 'CSR 1 Compliant',
                    'description' => 'Eligible for Corporate Social Responsibility',
                    'icon' => 'Building',
                    'color' => '#af0c5f',
                ],
                [
                    'title' => 'Bank Verified',
                    'description' => 'All accounts are properly verified',
                    'icon' => 'Lock',
                    'color' => '#35336e',
                ],
            ],
            'impact_stats' => [
                [
                    'label' => 'Children Sheltered',
                    'value' => '275+',
                    'icon' => 'Home',
                ],
                [
                    'label' => 'Families Reunited',
                    'value' => '175+',
                    'icon' => 'Users',
                ],
                [
                    'label' => 'Monthly Support',
                    'value' => '400+',
                    'icon' => 'Heart',
                ],
                [
                    'label' => 'Years of Service',
                    'value' => '13+',
                    'icon' => 'Star',
                ],
            ],
            'instructions' => [
                [
                    'title' => 'Transaction Remarks',
                    'description' => 'Always mention \'DONATION-SSBSS\' in the transaction remarks',
                    'icon' => '✅',
                ],
                [
                    'title' => 'Email Receipt',
                    'description' => 'Email your transaction receipt to donations@ssbss.org for 80G certificate',
                    'icon' => '📧',
                ],
                [
                    'title' => 'PAN Details',
                    'description' => 'Share your PAN number for tax exemption certificate',
                    'icon' => '📄',
                ],
                [
                    'title' => 'Tax Benefits',
                    'description' => 'All donations eligible for 50% tax deduction under section 80G',
                    'icon' => '💰',
                ],
                [
                    'title' => 'Processing Time',
                    'description' => '80G certificate issued within 7-10 working days',
                    'icon' => '⏰',
                ],
                [
                    'title' => 'Security',
                    'description' => 'Never share OTP or password. We only need transaction receipt',
                    'icon' => '🔒',
                ],
            ],
            'is_active' => true,
        ]);
    }
}