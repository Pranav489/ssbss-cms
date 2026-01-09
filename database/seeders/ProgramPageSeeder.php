<?php

namespace Database\Seeders;

use App\Models\ProgramPage;
use Illuminate\Database\Seeder;

class ProgramPageSeeder extends Seeder
{
    public function run(): void
    {
        $programPages = [
            [
                'title' => 'Shivshyadri Bahuuddeshiya Sevabhavi Sanstha (SSBSS)',
                'slug' => 'ssbss-organization',
                'category' => 'welfare',
                'category_icon' => 'Shield',
                'tagline' => 'Guardians of Innocence - Serving Maharashtra since 9 years',
                'hero_image' => 'organization-hero.jpg',
                'hero_alt' => 'SSBSS team working with children in Maharashtra',
                'overview' => "Shivshyadri Bahuuddeshiya Sevabhavi Sanstha (SSBSS), registered under Bombay Trust Act 1860 and Society Registration Act 1950, has been serving as 'Guardians of Innocence' for the past nine years.\n\nRegistered on Niti Darpan Portal (MH/2018/0195897) with 80G, 12A, and CSR 1 certificates, we work across Nashik, Ahilyanagar, and Palghar districts in Maharashtra.\n\nOur mission focuses on women's empowerment, children's education, care and protection of children, special training centers for child labour, sports, training, contact points for street children, and adoption services.\n\nWe organize various social activities annually and disseminate government schemes to reach the most vulnerable communities.",
                'location' => 'Nimgaon Paga, Sangamner, Ahilyanagar, Maharashtra',
                'address' => 'A/p Nimgaon paga, Tal. Sangamner, Dist. Ahilyanagar, Maharashtra - 422605',
                'registration_number' => 'MH/2018/0195897',
                'registration_authority' => 'Bombay Trust Act 1860 & Society Registration Act 1950',
                'highlights' => [
                    '• 80G & 12A Certified',
                    '• CSR 1 Registered',
                    '• NITI Aayog Registered',
                    '• Working across 3 districts',
                    '• 9+ years of service',
                    '• Guardians of Innocence'
                ],
                'hero_stats' => [
                    ['value' => '9+', 'label' => 'Years of Service'],
                    ['value' => '3', 'label' => 'Districts'],
                    ['value' => '80G & 12A', 'label' => 'Certified'],
                    ['value' => 'CSR 1', 'label' => 'Registered']
                ],
                'statistics' => [
                    ['value' => '400+', 'label' => 'Children in Sangopan Yojana'],
                    ['value' => '275+', 'label' => 'Street Children Identified'],
                    ['value' => '175+', 'label' => 'Children Reunited'],
                    ['value' => '4', 'label' => 'Major Projects']
                ],
                'categories_title' => 'Our Focus Areas',
                'categories_description' => 'Comprehensive social development programs across multiple sectors',
                'categories' => [
                    [
                        'title' => 'Children Protection',
                        'description' => 'Orphanage, shelter homes, adoption agencies for vulnerable children',
                        'icon_emoji' => 'Shield',
                        'eligibility' => 'Children in need of care and protection'
                    ],
                    [
                        'title' => 'Women Empowerment',
                        'description' => 'Counseling centers, working women hostels, one-stop centers',
                        'icon_emoji' => 'Users',
                        'eligibility' => 'Women in difficult circumstances'
                    ],
                    [
                        'title' => 'Education & Training',
                        'description' => 'Training programs, sensitization programs, education facilities',
                        'icon_emoji' => 'BookOpen',
                        'eligibility' => 'Children and community members'
                    ],
                    [
                        'title' => 'Child Labour Rescue',
                        'description' => 'Special training centers for rescued child labourers',
                        'icon_emoji' => 'HandHeart',
                        'eligibility' => 'Rescued child labourers'
                    ]
                ],
                'services_title' => 'Our Services',
                'services_description' => 'Comprehensive support services for vulnerable communities',
                'services' => [
                    [
                        'title' => 'Orphanage & Shelter Homes',
                        'description' => 'Safe residential care for orphaned and abandoned children',
                        'details' => '24/7 care, nutrition, education, and emotional support in a family-like environment',
                        'icon' => 'Home',
                        'color' => 'blue',
                        'eligibility' => 'Orphans, abandoned, and surrendered children'
                    ],
                    [
                        'title' => 'Adoption Services',
                        'description' => 'Legal adoption process following CARA regulations 2022',
                        'details' => 'End-to-end adoption process, home studies, counseling, and post-adoption support',
                        'icon' => 'Heart',
                        'color' => 'red',
                        'eligibility' => 'Eligible adoptive parents and adoptable children'
                    ],
                    [
                        'title' => 'Women Counseling Center',
                        'description' => 'Psychological support and guidance for women',
                        'details' => 'Individual and group counseling, legal aid, crisis intervention',
                        'icon' => 'MessageCircle',
                        'color' => 'purple',
                        'eligibility' => 'Women in difficult circumstances'
                    ]
                ],
                'process_title' => 'How We Work',
                'process_description' => 'Structured approach to social development and child protection',
                'process_steps' => [
                    [
                        'step_number' => 1,
                        'title' => 'Community Assessment',
                        'description' => 'Identify needs and vulnerabilities in target communities',
                        'duration' => '1-2 weeks'
                    ],
                    [
                        'step_number' => 2,
                        'title' => 'Program Design',
                        'description' => 'Develop tailored intervention strategies',
                        'duration' => '2-3 weeks'
                    ],
                    [
                        'step_number' => 3,
                        'title' => 'Implementation',
                        'description' => 'Execute programs with trained staff and resources',
                        'duration' => 'Ongoing'
                    ],
                    [
                        'step_number' => 4,
                        'title' => 'Monitoring & Evaluation',
                        'description' => 'Regular assessment and impact measurement',
                        'duration' => 'Continuous'
                    ]
                ],
                'process_note' => 'All programs are designed with community participation and follow government guidelines.',
                'required_documents' => '• Registration Certificate under Bombay Trust Act 1860
• Society Registration Certificate 1950
• 80G & 12A Certificates
• CSR 1 Certificate
• Niti Darpan Registration (MH/2018/0195897)
• Audited Financial Statements
• Annual Activity Reports',
                'documents_note' => 'All documents are verified and updated regularly as per government regulations.',
                'success_stories' => [
                    [
                        'title' => 'Transforming Lives Through Education',
                        'description' => 'Supporting 50+ children from vulnerable backgrounds to complete their education',
                        'benefit' => 'Improved literacy rates and future opportunities',
                        'image_url' => 'education-success.jpg',
                        'alt' => 'Children studying in school'
                    ],
                    [
                        'title' => 'Women\'s Empowerment Success',
                        'description' => 'Helped 30+ women start small businesses through training and micro-finance',
                        'benefit' => 'Economic independence and improved family wellbeing',
                        'image_url' => 'women-empowerment.jpg',
                        'alt' => 'Women entrepreneurs'
                    ]
                ],
                'gallery_title' => 'Our Work in Action',
                'gallery_description' => 'Capturing moments of transformation and impact',
                'gallery' => [
                    [
                        'url' => 'gallery-community.jpg',
                        'alt' => 'Community engagement activities',
                        'caption' => 'Community awareness programs'
                    ],
                    [
                        'url' => 'gallery-children.jpg',
                        'alt' => 'Happy children at our center',
                        'caption' => 'Children\'s day celebrations'
                    ]
                ],
                'contact_title' => 'Contact Us',
                'contact_description' => 'Get in touch with us for collaborations, donations, or volunteer opportunities',
                'contact_phone' => '+91 9876543210',
                'contact_email' => 'info@ssbss.org',
                'contact_hours' => 'Monday to Saturday, 10:00 AM - 6:00 PM',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Astha Boys Open Shelter Home',
                'slug' => 'astha-boys-open-shelter',
                'category' => 'shelter',
                'category_icon' => 'Home',
                'tagline' => 'Safe Haven for Street and Vulnerable Children in Nashik',
                'hero_image' => 'shelter-hero.jpg',
                'hero_alt' => 'Boys at Astha shelter participating in educational activities',
                'overview' => "Astha Boys Open Shelter Home, operational for over four years in Dwarka, Nashik, provides immediate shelter and comprehensive care for street children, child beggars, runaways, missing children, and child labourers.\n\nRegistered under Juvenile Justice Act 2015, Section 41 with the Department of Women and Child Development, our shelter offers a safe, nurturing environment for boys in crisis situations.\n\nOur primary objective is to provide shelter, medical care, nutrition, recreation, and family reunification services, ensuring every child's right to protection and care is upheld.\n\nWe've successfully reunited 175+ missing and found children with their families over the past four years, providing them with a second chance at childhood.",
                'location' => 'Dwarka, Nashik',
                'address' => 'Pragati Society, Nanawali Road, Behind Tractor House, Dwarka, Nashik - 422011',
                'coordinates' => '19.9975,73.7898',
                'registration_number' => 'JJ Act 2015 Section 41',
                'registration_authority' => 'Department of Women and Child Development, Maharashtra',
                'highlights' => [
                    '• 24/7 Emergency Shelter',
                    '• Family Reunification Services',
                    '• Medical & Counseling Support',
                    '• Educational Assistance',
                    '• Recreation Activities',
                    '• Nutritional Support'
                ],
                'hero_stats' => [
                    ['value' => '4+', 'label' => 'Years Running'],
                    ['value' => '175+', 'label' => 'Children Reunited'],
                    ['value' => '24/7', 'label' => 'Emergency Shelter'],
                    ['value' => '100%', 'label' => 'Medical Care']
                ],
                'statistics' => [
                    ['value' => '175+', 'label' => 'Family Reunions'],
                    ['value' => '500+', 'label' => 'Medical Checkups'],
                    ['value' => '300+', 'label' => 'Counseling Sessions'],
                    ['value' => '98%', 'label' => 'Success Rate']
                ],
                'categories_title' => 'Who We Serve',
                'categories_description' => 'Children in need of immediate care and protection',
                'categories' => [
                    [
                        'title' => 'Street Children',
                        'description' => 'Children living and working on streets',
                        'icon_emoji' => 'MapPin',
                        'eligibility' => 'Children found on streets without guardians'
                    ],
                    [
                        'title' => 'Runaway Children',
                        'description' => 'Children who have left home voluntarily',
                        'icon_emoji' => 'Users',
                        'eligibility' => 'Children separated from families'
                    ],
                    [
                        'title' => 'Missing Children',
                        'description' => 'Children reported missing by families',
                        'icon_emoji' => 'Search',
                        'eligibility' => 'Children identified through police/childline'
                    ],
                    [
                        'title' => 'Child Labourers',
                        'description' => 'Rescued child labourers',
                        'icon_emoji' => 'Briefcase',
                        'eligibility' => 'Children rescued from labour situations'
                    ]
                ],
                'services_title' => 'Our Services',
                'services_description' => 'Comprehensive care and rehabilitation services',
                'services' => [
                    [
                        'title' => 'Safe Accommodation',
                        'description' => 'Short-term shelter in an open, family-like environment',
                        'details' => 'Clean, safe dormitories with bedding, storage, and personal care items',
                        'icon' => 'Home',
                        'color' => 'blue',
                        'eligibility' => 'Boys aged 6-18 years in crisis situations'
                    ],
                    [
                        'title' => 'Nutrition & Medical Care',
                        'description' => 'Complete nutritional support and healthcare services',
                        'details' => 'Three balanced meals daily, regular health checkups, emergency medical care',
                        'icon' => 'MedicalCross',
                        'color' => 'green',
                        'eligibility' => 'All children admitted to the shelter'
                    ],
                    [
                        'title' => 'Counseling & Emotional Support',
                        'description' => 'Psychological counseling for trauma recovery',
                        'details' => 'Individual and group therapy sessions, art therapy, emotional regulation training',
                        'icon' => 'MessageCircle',
                        'color' => 'purple',
                        'eligibility' => 'Children showing signs of trauma or distress'
                    ]
                ],
                'process_title' => 'Our Rehabilitation Process',
                'process_description' => 'Systematic approach to rescue, rehabilitation, and reintegration',
                'process_steps' => [
                    [
                        'step_number' => 1,
                        'title' => 'Rescue & Admission',
                        'description' => 'Children rescued through outreach or brought by authorities',
                        'duration' => 'Immediate'
                    ],
                    [
                        'step_number' => 2,
                        'title' => 'Medical Assessment',
                        'description' => 'Complete health checkup and documentation',
                        'duration' => '24 hours'
                    ],
                    [
                        'step_number' => 3,
                        'title' => 'Care & Rehabilitation',
                        'description' => 'Shelter, education, counseling, and skill development',
                        'duration' => '1-3 months'
                    ],
                    [
                        'step_number' => 4,
                        'title' => 'Family Tracing',
                        'description' => 'Systematic search for family members',
                        'duration' => '2-4 weeks'
                    ]
                ],
                'process_note' => 'Each child receives individualized care plan based on their unique circumstances.',
                'required_documents' => '• Child Welfare Committee (CWC) Order
• Medical Fitness Certificate
• Police Report (if applicable)
• Identification Documents
• Previous Address Proof
• Photographs of Child',
                'success_stories' => [
                    [
                        'title' => 'Rohan\'s Journey Home',
                        'description' => '12-year-old Rohan was found at Nashik railway station. After 45 days at our shelter, we reunited him with his family in Bihar.',
                        'benefit' => 'Successfully reunited with family after 6 months of separation',
                        'image_url' => 'rohan-reunion.jpg',
                        'alt' => 'Rohan reunited with his family'
                    ],
                    [
                        'title' => 'From Streets to School',
                        'description' => 'Vikas, 14, was a child beggar. Through our education program, he\'s now attending regular school.',
                        'benefit' => 'Enrolled in formal education and showing excellent progress',
                        'image_url' => 'vikas-school.jpg',
                        'alt' => 'Vikas studying in school'
                    ]
                ],
                'gallery_title' => 'Shelter Life',
                'gallery_description' => 'Daily activities and moments at our shelter',
                'gallery' => [
                    [
                        'url' => 'shelter-classroom.jpg',
                        'alt' => 'Children studying in shelter classroom',
                        'caption' => 'Educational activities'
                    ],
                    [
                        'url' => 'shelter-sports.jpg',
                        'alt' => 'Children playing sports',
                        'caption' => 'Recreation time'
                    ]
                ],
                'contact_title' => 'Contact Shelter',
                'contact_description' => 'For emergency admissions or inquiries about our shelter services',
                'contact_phone' => '+91 9876543211',
                'contact_email' => 'shelter@ssbss.org',
                'contact_hours' => '24/7 Emergency Shelter - Always Open',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Astha Shishugruha',
                'slug' => 'astha-shishugruha',
                'category' => 'adoption',
                'category_icon' => 'Heart',
                'tagline' => 'Specialised Adoption Agency - Creating Forever Families',
                'hero_image' => 'adoption-hero.jpg',
                'hero_alt' => 'Happy children at Astha Shishugruha adoption home',
                'overview' => "Astha Shishugruha, our Specialised Adoption Agency in Umroli, Palghar, provides loving care for orphans, abandoned, and surrendered children while implementing the adoption process as per CARA Regulations 2022.\n\nRegistered under Juvenile Justice Act 2015, Section 41, we operate on a non-grant basis, ensuring sustainable and quality care for vulnerable children.\n\nWe admit children by order of the Child Welfare Committee and provide comprehensive care including shelter, nutrition, medical care, education, and emotional support while preparing them for adoption into loving families.\n\nOur facility follows all CARA guidelines strictly, ensuring ethical, transparent, and child-centric adoption processes that prioritize the child's best interests.",
                'location' => 'Umroli, Palghar',
                'address' => 'Plot No. 12, Near Railway Station, Umroli, Taluka & District Palghar, Maharashtra - 401404',
                'coordinates' => '19.6925,72.7634',
                'registration_number' => 'JJ Act 2015 Section 41 - PAL-9/SAA/2024/504',
                'registration_authority' => 'Juvenile Justice Board, Palghar',
                'highlights' => [
                    '• CARA 2022 Compliant',
                    '• Non-Grant Basis Operation',
                    '• 24/7 Child Care',
                    '• Medical & Nutritional Support',
                    '• Pre & Post Adoption Counseling',
                    '• Transparent Process'
                ],
                'hero_stats' => [
                    ['value' => '0-6', 'label' => 'Age Group'],
                    ['value' => 'Institutional', 'label' => 'Care Type'],
                    ['value' => 'CARA 2022', 'label' => 'Compliant'],
                    ['value' => 'Non-Grant', 'label' => 'Funding Model']
                ],
                'statistics' => [
                    ['value' => '50+', 'label' => 'Children Cared'],
                    ['value' => '30+', 'label' => 'Successful Adoptions'],
                    ['value' => '100%', 'label' => 'Follow-up Rate'],
                    ['value' => '4.8', 'label' => 'Avg. Rating']
                ],
                'categories_title' => 'Children We Serve',
                'categories_description' => 'Various categories of children in need of permanent families',
                'categories' => [
                    [
                        'title' => 'Orphan Children',
                        'description' => 'Children who have lost both parents',
                        'icon_emoji' => 'Heart',
                        'eligibility' => 'Verified orphan status by CWC'
                    ],
                    [
                        'title' => 'Abandoned Children',
                        'description' => 'Children found abandoned in public places',
                        'icon_emoji' => 'MapPin',
                        'eligibility' => 'Police report and CWC order'
                    ],
                    [
                        'title' => 'Surrendered Children',
                        'description' => 'Children voluntarily surrendered by biological parents',
                        'icon_emoji' => 'HandHeart',
                        'eligibility' => 'Legal surrender deed and CWC approval'
                    ]
                ],
                'services_title' => 'Our Services',
                'services_description' => 'Comprehensive adoption and child care services',
                'services' => [
                    [
                        'title' => 'Shelter & Care',
                        'description' => 'Safe, homely environment with 24/7 care',
                        'details' => 'Age-appropriate facilities, nurturing caregivers, structured daily routine',
                        'icon' => 'Home',
                        'color' => 'blue',
                        'eligibility' => 'All admitted children'
                    ],
                    [
                        'title' => 'Adoption Processing',
                        'description' => 'End-to-end legal adoption process',
                        'details' => 'Home studies, document processing, court procedures, post-adoption follow-up',
                        'icon' => 'Heart',
                        'color' => 'red',
                        'eligibility' => 'Legally free children and approved adoptive parents'
                    ],
                    [
                        'title' => 'Counseling Services',
                        'description' => 'Emotional support for children and families',
                        'details' => 'Child psychology, pre-adoption counseling, post-adoption support',
                        'icon' => 'MessageCircle',
                        'color' => 'purple',
                        'eligibility' => 'Children and prospective adoptive parents'
                    ]
                ],
                'process_title' => 'Adoption Process Timeline',
                'process_description' => 'Transparent, legal process ensuring the child\'s best interests',
                'process_steps' => [
                    [
                        'step_number' => 1,
                        'title' => 'Child Admission',
                        'description' => 'Child admitted by CWC order and medical checkup',
                        'duration' => '24-48 hours'
                    ],
                    [
                        'step_number' => 2,
                        'title' => 'Declared Legally Free',
                        'description' => 'CWC declares child legally free for adoption',
                        'duration' => '60 days'
                    ],
                    [
                        'step_number' => 3,
                        'title' => 'Registration on CARINGS',
                        'description' => 'Child\'s profile uploaded on Central Adoption Resource Authority portal',
                        'duration' => '7 days'
                    ],
                    [
                        'step_number' => 4,
                        'title' => 'Parent Matching',
                        'description' => 'Prospective parents matched based on compatibility',
                        'duration' => '30-60 days'
                    ]
                ],
                'process_note' => 'All timelines are approximate and may vary based on individual circumstances.',
                'required_documents' => '• CWC Order for Admission
• Medical Certificate
• Birth Certificate (if available)
• Police Report (for abandoned children)
• Surrender Deed (for surrendered children)
• Photographs of Child',
                'success_stories' => [
                    [
                        'title' => 'Little Anaya Finds Her Forever Home',
                        'description' => 'Abandoned at birth, Anaya spent her first year at our Shishugruha. She was adopted by a loving couple from Mumbai.',
                        'benefit' => 'Successful domestic adoption with excellent developmental progress',
                        'image_url' => 'anaya-adoption.jpg',
                        'alt' => 'Anaya with her adoptive family'
                    ],
                    [
                        'title' => 'Brothers Reunited Through Adoption',
                        'description' => 'Two brothers, separated after being orphaned, were both placed in our care and adopted together.',
                        'benefit' => 'Sibling group adoption maintaining family bonds',
                        'image_url' => 'brothers-adoption.jpg',
                        'alt' => 'Two brothers with their new family'
                    ]
                ],
                'gallery_title' => 'Our Children',
                'gallery_description' => 'Moments of joy and care at our Shishugruha',
                'gallery' => [
                    [
                        'url' => 'shishugruha-play.jpg',
                        'alt' => 'Children playing in play area',
                        'caption' => 'Play time activities'
                    ],
                    [
                        'url' => 'shishugruha-learning.jpg',
                        'alt' => 'Children learning activities',
                        'caption' => 'Early childhood education'
                    ]
                ],
                'contact_title' => 'Adoption Inquiries',
                'contact_description' => 'For adoption inquiries, counseling, or information about our services',
                'contact_phone' => '+91 9876543212',
                'contact_email' => 'adoption@ssbss.org',
                'contact_hours' => 'Mon-Sat, 10:00 AM - 6:00 PM',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Balsnehi Firte Pathak',
                'slug' => 'balsnehi-firte-pathak',
                'category' => 'outreach',
                'category_icon' => 'Users',
                'tagline' => 'Mobile Outreach for Street Children in Nashik City',
                'hero_image' => 'outreach-hero.jpg',
                'hero_alt' => 'Outreach workers interacting with street children in Nashik',
                'overview' => "Balsnehi Firte Pathak (Child-Friendly Mobile Unit) is our innovative outreach program for children living in street situations across Nashik City.\n\nOperating under the Women and Child Development Department, we've identified 275+ street children from 15 strategic hotspots including railway stations, bus stands, markets, and temple areas.\n\nOur mobile teams work directly on the streets, building trust with vulnerable children and providing immediate support while connecting them to long-term services.\n\nThe program focuses on identification, immediate need fulfillment, and linking children to appropriate government schemes and rehabilitation services.",
                'location' => 'Nashik City',
                'address' => '15 hotspots across Nashik City including Railway Station, Bus Stand, and Market Areas',
                'highlights' => [
                    '• Mobile Outreach Units',
                    '• 15 Hotspots Identified',
                    '• Aadhar Card Enrollment',
                    '• Medical & Nutritional Support',
                    '• Informal Education',
                    '• Family Reunification'
                ],
                'hero_stats' => [
                    ['value' => '275+', 'label' => 'Children Identified'],
                    ['value' => '15', 'label' => 'Hotspots'],
                    ['value' => '100%', 'label' => 'Medical Screening'],
                    ['value' => '85%', 'label' => 'Aadhar Enrollment']
                ],
                'statistics' => [
                    ['value' => '275+', 'label' => 'Children Identified'],
                    ['value' => '15', 'label' => 'Hotspots Covered'],
                    ['value' => '150+', 'label' => 'Aadhar Cards Issued'],
                    ['value' => '50+', 'label' => 'Children Rehabilitated']
                ],
                'categories_title' => 'Areas We Cover',
                'categories_description' => 'Key locations where street children are concentrated',
                'categories' => [
                    [
                        'title' => 'Railway Station',
                        'description' => 'Children living around Nashik Railway Station',
                        'icon_emoji' => 'Train',
                        'eligibility' => 'Children found at railway premises'
                    ],
                    [
                        'title' => 'Bus Stand',
                        'description' => 'Children around CBS and other bus stands',
                        'icon_emoji' => 'Bus',
                        'eligibility' => 'Street children in bus terminal areas'
                    ],
                    [
                        'title' => 'Market Areas',
                        'description' => 'Children in commercial and market zones',
                        'icon_emoji' => 'ShoppingBag',
                        'eligibility' => 'Children working/living in markets'
                    ],
                    [
                        'title' => 'Temple Areas',
                        'description' => 'Children around religious places',
                        'icon_emoji' => 'Church',
                        'eligibility' => 'Children in temple premises'
                    ]
                ],
                'services_title' => 'Outreach Services',
                'services_description' => 'Mobile services delivered directly to street children',
                'services' => [
                    [
                        'title' => 'Identification & Registration',
                        'description' => 'Systematic identification and documentation of street children',
                        'details' => 'Mobile surveys, trust-building, basic documentation, hotspot mapping',
                        'icon' => 'Search',
                        'color' => 'blue',
                        'eligibility' => 'Children living/working on streets'
                    ],
                    [
                        'title' => 'Aadhar Card Enrollment',
                        'description' => 'Identity document facilitation for access to services',
                        'details' => 'Mobile Aadhar camps, document assistance, biometric enrollment',
                        'icon' => 'FileText',
                        'color' => 'green',
                        'eligibility' => 'Children without valid identity documents'
                    ],
                    [
                        'title' => 'Medical & Nutrition',
                        'description' => 'Immediate health and nutritional support',
                        'details' => 'Mobile health checkups, nutrition kits, referral to hospitals',
                        'icon' => 'MedicalCross',
                        'color' => 'red',
                        'eligibility' => 'All identified street children'
                    ]
                ],
                'process_title' => 'Outreach Process',
                'process_description' => 'Systematic approach to reaching and helping street children',
                'process_steps' => [
                    [
                        'step_number' => 1,
                        'title' => 'Hotspot Identification',
                        'description' => 'Identify areas with high concentration of street children',
                        'duration' => 'Ongoing'
                    ],
                    [
                        'step_number' => 2,
                        'title' => 'Trust Building',
                        'description' => 'Regular visits and rapport building with children',
                        'duration' => '2-4 weeks'
                    ],
                    [
                        'step_number' => 3,
                        'title' => 'Need Assessment',
                        'description' => 'Comprehensive assessment of each child\'s situation',
                        'duration' => '1-2 weeks'
                    ],
                    [
                        'step_number' => 4,
                        'title' => 'Service Provision',
                        'description' => 'Immediate support and referral to services',
                        'duration' => 'Ongoing'
                    ]
                ],
                'required_documents' => '• Identification Proof (if available)
• Photograph of Child
• Basic Information Form
• Medical History (if known)',
                'success_stories' => [
                    [
                        'title' => 'From Streets to Shelter',
                        'description' => '12-year-old Raju, living at railway station for 2 years, now in shelter and attending school',
                        'benefit' => 'Safe shelter, education, and family tracing initiated',
                        'image_url' => 'raju-story.jpg',
                        'alt' => 'Raju at shelter home'
                    ],
                    [
                        'title' => 'Healthcare Access',
                        'description' => 'Provided medical treatment to 25+ children with health issues through mobile clinics',
                        'benefit' => 'Improved health outcomes and medical follow-up',
                        'image_url' => 'health-clinic.jpg',
                        'alt' => 'Mobile health clinic'
                    ]
                ],
                'gallery_title' => 'Outreach in Action',
                'gallery_description' => 'Our mobile teams working with street children',
                'gallery' => [
                    [
                        'url' => 'outreach-railway.jpg',
                        'alt' => 'Outreach at railway station',
                        'caption' => 'Daily outreach at Nashik Railway Station'
                    ],
                    [
                        'url' => 'outreach-medical.jpg',
                        'alt' => 'Mobile health checkup',
                        'caption' => 'Health screening camp'
                    ]
                ],
                'contact_title' => 'Outreach Team',
                'contact_description' => 'For reporting street children or volunteering with outreach',
                'contact_phone' => '+91 9876543213',
                'contact_email' => 'outreach@ssbss.org',
                'contact_hours' => 'Daily, 9:00 AM - 5:00 PM (Mobile Unit Schedule)',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Krantijyoti Savitribai Phule Bal Sangopan Yojana',
                'slug' => 'bal-sangopan-yojana',
                'category' => 'welfare',
                'category_icon' => 'Wallet',
                'tagline' => 'Family-Based Care Support for Vulnerable Children',
                'hero_image' => 'sangopan-hero.jpg',
                'hero_alt' => 'Children receiving support under Bal Sangopan Yojana',
                'overview' => "The Krantijyoti Savitribai Phule Bal Sangopan Yojana is a flagship program implemented across Nashik and Ahilyanagar districts under the Women and Child Development Department.\n\nWe support 400+ vulnerable children including orphans, children of single parents, prisoners' children, special needs children, and divyang children with monthly financial assistance of ₹2250 deposited directly into their bank accounts.\n\nThe program's primary objective is to ensure children are raised within their family environment rather than institutions, preserving family bonds while providing necessary financial support.\n\nOur role includes beneficiary identification, documentation support, bank account opening assistance, and regular monitoring to ensure the funds are utilized for the child's welfare.",
                'location' => 'Nashik & Ahilyanagar Districts',
                'address' => 'Covering multiple blocks across Nashik and Ahilyanagar districts',
                'highlights' => [
                    '• Monthly ₹2250 Support',
                    '• Direct Bank Transfer',
                    '• Family-Based Care',
                    '• Regular Monitoring',
                    '• Educational Support',
                    '• Healthcare Linkage'
                ],
                'hero_stats' => [
                    ['value' => '400+', 'label' => 'Children Benefited'],
                    ['value' => '₹2250', 'label' => 'Monthly Support'],
                    ['value' => '2', 'label' => 'Districts Covered'],
                    ['value' => '100%', 'label' => 'Direct Bank Transfer']
                ],
                'statistics' => [
                    ['value' => '400+', 'label' => 'Active Beneficiaries'],
                    ['value' => '₹9,00,000', 'label' => 'Monthly Disbursement'],
                    ['value' => '100%', 'label' => 'Bank Account Linked'],
                    ['value' => 'Monthly', 'label' => 'Support Continuity']
                ],
                'categories_title' => 'Eligible Categories',
                'categories_description' => 'Various categories of children eligible for support',
                'categories' => [
                    [
                        'title' => 'Orphan Children',
                        'description' => 'Children who have lost both parents',
                        'icon_emoji' => 'Users',
                        'eligibility' => 'Death certificates of both parents'
                    ],
                    [
                        'title' => 'Single Parent Children',
                        'description' => 'Children living with single surviving parent',
                        'icon_emoji' => 'User',
                        'eligibility' => 'Income certificate and single parent affidavit'
                    ],
                    [
                        'title' => 'Prisoners\' Children',
                        'description' => 'Children with parent(s) in prison',
                        'icon_emoji' => 'Scales',
                        'eligibility' => 'Prison certificate and custody proof'
                    ],
                    [
                        'title' => 'Special Needs Children',
                        'description' => 'Children with disabilities',
                        'icon_emoji' => 'Wheelchair',
                        'eligibility' => 'Disability certificate (40%+ disability)'
                    ]
                ],
                'services_title' => 'Our Support Services',
                'services_description' => 'Comprehensive support for beneficiaries',
                'services' => [
                    [
                        'title' => 'Financial Assistance',
                        'description' => 'Monthly ₹2250 direct bank transfer',
                        'details' => 'Regular disbursement, SMS alerts, passbook updating support',
                        'icon' => 'Wallet',
                        'color' => 'green',
                        'eligibility' => 'Approved beneficiaries'
                    ],
                    [
                        'title' => 'Documentation Support',
                        'description' => 'Assistance with required documents and applications',
                        'details' => 'Help with birth certificates, income certificates, affidavits, photographs',
                        'icon' => 'FileText',
                        'color' => 'blue',
                        'eligibility' => 'All identified eligible children'
                    ],
                    [
                        'title' => 'Monitoring & Follow-up',
                        'description' => 'Regular visits to ensure proper utilization of funds',
                        'details' => 'Home visits, school progress tracking, expenditure monitoring',
                        'icon' => 'CheckCircle',
                        'color' => 'purple',
                        'eligibility' => 'All active beneficiaries'
                    ]
                ],
                'process_title' => 'Application Process',
                'process_description' => 'Simple steps to avail scheme benefits',
                'process_steps' => [
                    [
                        'step_number' => 1,
                        'title' => 'Application Collection',
                        'description' => 'Collection of applications with required documents',
                        'duration' => 'Monthly camps'
                    ],
                    [
                        'step_number' => 2,
                        'title' => 'Field Verification',
                        'description' => 'Home visits and verification by social workers',
                        'duration' => '15-30 days'
                    ],
                    [
                        'step_number' => 3,
                        'title' => 'Approval Process',
                        'description' => 'Submission to district committee for approval',
                        'duration' => '30-45 days'
                    ],
                    [
                        'step_number' => 4,
                        'title' => 'Bank Account Opening',
                        'description' => 'Assistance in opening zero-balance savings account',
                        'duration' => '7-15 days'
                    ]
                ],
                'process_note' => 'Applications are processed on a first-come-first-served basis subject to eligibility.',
                'required_documents' => '• Birth Certificate of Child
• Aadhar Card of Child and Guardian
• Income Certificate
• Death Certificate (for orphans)
• Single Parent Affidavit (if applicable)
• Disability Certificate (if applicable)
• Prison Certificate (if applicable)
• Bank Account Details
• Passport Size Photographs',
                'success_stories' => [
                    [
                        'title' => 'Educational Success',
                        'description' => 'Supported 50+ children to continue their education without financial burden',
                        'benefit' => 'Improved school attendance and academic performance',
                        'image_url' => 'education-support.jpg',
                        'alt' => 'Children with educational materials'
                    ],
                    [
                        'title' => 'Healthcare Access',
                        'description' => 'Enabled families to afford medical treatment for children with special needs',
                        'benefit' => 'Better health outcomes and regular treatment',
                        'image_url' => 'healthcare-access.jpg',
                        'alt' => 'Child receiving medical care'
                    ]
                ],
                'gallery_title' => 'Scheme Beneficiaries',
                'gallery_description' => 'Children and families benefiting from the scheme',
                'gallery' => [
                    [
                        'url' => 'sangopan-family.jpg',
                        'alt' => 'Family receiving scheme benefits',
                        'caption' => 'Family support sessions'
                    ],
                    [
                        'url' => 'sangopan-education.jpg',
                        'alt' => 'Children with educational kits',
                        'caption' => 'Educational support'
                    ]
                ],
                'contact_title' => 'Scheme Inquiries',
                'contact_description' => 'For information, applications, or inquiries about Bal Sangopan Yojana',
                'contact_phone' => '+91 9876543214',
                'contact_email' => 'sangopan@ssbss.org',
                'contact_hours' => 'Mon-Fri, 10:00 AM - 5:00 PM',
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($programPages as $programData) {
            ProgramPage::create($programData);
        }

    }
}