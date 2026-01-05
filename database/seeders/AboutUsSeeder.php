<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing
        AboutUs::query()->delete();

        AboutUs::create([
            'header_description' => "For nine years, we've been nurturing childhoods and building futures across Maharashtra, one child at a time.",
            
            'header_stats' => [
                ['heading' => 'Years  Serving', 'number' => '9+'],
                ['heading' => 'Districts', 'number' => '3+'],
                ['heading' => 'Lives Impacted', 'number' => '850+'],
                ['heading' => 'Core Programs', 'number' => '4'],
            ],
            
            'about_content' => <<<HTML
<p><strong>Shivshyadri Bahuuddeshiya Sevabhavi Sanstha (SSBSS)</strong> is a registered non-profit organization based in Ahilyanagar, Maharashtra. Established in 2015, we operate under the Bombay Trust Act 1860 and Society Registration Act 1950.</p>

<p>With the slogan "Guardians of Innocence," we work across Nashik, Ahilyanagar, and Palghar districts focusing on women's empowerment, children's education, and comprehensive child protection services.</p>

<p>Our organization conducts various social activities annually and serves as a bridge between government welfare schemes and the communities that need them most.</p>
HTML,
            
            'about_image_alt' => 'Children participating in SSBSS educational programs',
            
            'registrations' => [
                [
                    'certificate' => 'The Societies Registration Act - 1860',
                    'number' => 'MAHA/659/2013/A.nagar',
                    'date' => '12.08.2013',
                    'icon' => 'FileText',
                ],
                [
                    'certificate' => 'Bombay Public Trusts Act - 1950',
                    'number' => 'F- 17168',
                    'date' => '22.12.2013',
                    'icon' => 'Shield',
                ],
                [
                    'certificate' => 'NGO DARPAN (Niti Ayog)',
                    'number' => 'MH/2018/0195897',
                    'date' => '14.05.2018',
                    'icon' => 'Award',
                ],
                [
                    'certificate' => '12 A Registration',
                    'number' => 'AASTS5988DE2021901',
                    'date' => '04.01.2022',
                    'icon' => 'CheckCircle',
                ],
                [
                    'certificate' => '80 G Certificate',
                    'number' => 'AASTS5988DF20225',
                    'date' => '18.01.2022',
                    'icon' => 'Heart',
                ],
                [
                    'certificate' => 'CSR 1 Certificate',
                    'number' => 'CSR0042017',
                    'date' => '01.12.2022',
                    'icon' => 'Target',
                ],
                [
                    'certificate' => 'Astha Boys Open Shelter Home',
                    'number' => 'JJ Act 2015 - NSK/03/OS/2020/247',
                    'date' => 'Registered',
                    'icon' => 'Home',
                ],
                [
                    'certificate' => 'Astha Shishugruha (Adoption Agency)',
                    'number' => 'JJ Act 2015 - PAL-9/SAA/2024/504',
                    'date' => 'Registered',
                    'icon' => 'Users',
                ],
            ],
            
            'objectives' => [
                'Run orphanage, shelter homes, and adoption agency for children',
                'Operate counseling centers and shelters for women in difficult circumstances',
                'Conduct training programs for stakeholders',
                'Arrange sensitization programs',
                'Provide education facilities for children',
                'Organize camps for farmers',
                'Conduct sports and cultural competitions',
                'Work for child labor, street children, and child beggars',
            ],
            
            'projects' => [
                [
                    'name' => 'Astha Boys Open Shelter Home',
                    'location' => 'Dwarka, Nashik',
                    'description' => 'Shelter for street children, runaways, and children in need of care',
                    'icon' => 'Home',
                ],
                [
                    'name' => 'Balsnehi Firte Pathak',
                    'location' => 'Nashik City',
                    'description' => 'Outreach program for street children across 15 hotspots',
                    'icon' => 'Users',
                ],
                [
                    'name' => 'Bal Sangopan Yojana',
                    'location' => 'Nashik & Ahilyanagar',
                    'description' => 'Family-based welfare program supporting 400+ children',
                    'icon' => 'Heart',
                ],
                [
                    'name' => 'Astha Shishugruha',
                    'location' => 'Umroli, Palghar',
                    'description' => 'Specialised adoption agency for orphaned/abandoned children',
                    'icon' => 'BookOpen',
                ],
            ],
            
            'team_members' => [
                [
                    'name' => 'Mr. Narendra Kautik Hire',
                    'position' => 'President',
                    'image_alt' => 'Mr. Narendra Kautik Hire, President of SSBSS',
                ],
                [
                    'name' => 'Mr. Ravindra Vasantrao Sonawane',
                    'position' => 'Vice-Secretary',
                    'image_alt' => 'Mr. Ravindra Vasantrao Sonawane, Vice-Secretary of SSBSS',
                ],
                [
                    'name' => 'Mr. Rajendra Nivrutti Hase',
                    'position' => 'Secretary',
                    'image_alt' => 'Mr. Rajendra Nivrutti Hase, Secretary of SSBSS',
                ],
                [
                    'name' => 'Mr. Ratan Shantaram Sor',
                    'position' => 'Treasurer',
                    'image_alt' => 'Mr. Ratan Shantaram Sor, Treasurer',
                ],
                [
                    'name' => 'Mr. Rahul Manohar Jadhav',
                    'position' => 'Member',
                    'image_alt' => 'Mr. Rahul Manohar Jadhav, Member',
                ],
                [
                    'name' => 'Mrs. Madhuri Ganesh Kanawade',
                    'position' => 'Member',
                    'image_alt' => 'Mrs. Madhuri Ganesh Kanawade, Member',
                ],
                [
                    'name' => 'Mr. Shankar Punjiram Naikwadi',
                    'position' => 'Member',
                    'image_alt' => 'Mr. Shankar Punjiram Naikwadi',
                ],
            ],
            
            'show_registrations' => true,
            'show_objectives' => true,
            'show_projects' => true,
            'show_team' => true,
            'is_active' => true,
        ]);
    }
}