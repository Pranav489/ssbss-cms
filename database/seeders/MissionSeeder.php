<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing mission
        Mission::query()->delete();

        Mission::create([
            'heading' => 'Our Mission & Vision',
            'content' => '<h2>Our Mission</h2>
<p>To provide comprehensive care, protection, and rehabilitation services to vulnerable children, ensuring their right to survival, development, protection, and participation.</p>

<h2>Our Vision</h2>
<p>A society where every child grows up in a safe, nurturing, and loving environment with equal opportunities for development and empowerment.</p>

<h2>Our Core Values</h2>
<ul>
<li><strong>Child-Centric Approach:</strong> Every decision and action prioritizes the best interests of the child.</li>
<li><strong>Family Strengthening:</strong> Believing that every child deserves to grow in a family environment whenever possible.</li>
<li><strong>Community Participation:</strong> Engaging local communities in child protection mechanisms.</li>
<li><strong>Transparency & Accountability:</strong> Maintaining highest standards of governance and ethical practices.</li>
<li><strong>Inclusive Care:</strong> Providing services without discrimination based on gender, religion, caste, or economic status.</li>
</ul>',
            'quick_stats' => [
                [
                    'label' => 'Children Reached',
                    'value' => '850+',
                    'icon' => 'Users',
                    'color' => '#3b82f6',
                ],
                [
                    'label' => 'Years of Service',
                    'value' => '13+',
                    'icon' => 'Calendar',
                    'color' => '#10b981',
                ],
                [
                    'label' => 'Families Strengthened',
                    'value' => '400+',
                    'icon' => 'Heart',
                    'color' => '#ef4444',
                ],
                [
                    'label' => 'Successful Reunions',
                    'value' => '175+',
                    'icon' => 'Home',
                    'color' => '#f59e0b',
                ],
            ],
            'districts_covered' => 'Nashik, Ahmednagar, Palghar',
            'image_alt' => 'SSBSS team working with children in community',
            'is_active' => true,
        ]);
    }
}