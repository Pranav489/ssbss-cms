<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'All',
                'slug' => 'all',
                'icon' => 'FileText',
                'description' => 'All documents',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Reports',
                'slug' => 'annual-reports',
                'icon' => 'BookOpen',
                'description' => 'Annual reports and activity reports',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Certifications',
                'slug' => 'certifications',
                'icon' => 'Award',
                'description' => 'Certificates and registrations',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Policies',
                'slug' => 'policies',
                'icon' => 'Shield',
                'description' => 'Policies and guidelines',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Financial',
                'slug' => 'financial',
                'icon' => 'FileSpreadsheet',
                'description' => 'Financial statements and reports',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'slug' => 'legal',
                'icon' => 'FileCheck',
                'description' => 'Legal documents and registrations',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Forms',
                'slug' => 'forms',
                'icon' => 'FileType',
                'description' => 'Application forms and templates',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Brochures',
                'slug' => 'brochures',
                'icon' => 'File',
                'description' => 'Brochures and informational materials',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            DocumentCategory::create($category);
        }
    }
}