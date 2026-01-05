<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactMetric extends Model
{
    protected $fillable = [
        'icon',
        'number',
        'label',
        'description',
        'image_alt',
        'project_link',
        'image_path',
        'sort_order',
        'is_active',
        'show_image',
        'highlight'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_image' => 'boolean',
        'highlight' => 'boolean',
    ];

    // Available icons for dropdown
    public static function availableIcons(): array
    {
        return [
            'Users' => 'Users',
            'Home' => 'Home',
            'Heart' => 'Heart',
            'Shield' => 'Shield',
            'MapPin' => 'MapPin',
            'Award' => 'Award',
            'Child' => 'Child',
            'Users2' => 'Users2',
            'Family' => 'Users2',
            'Star' => 'Star',
            'Calendar' => 'Calendar',
            'Target' => 'Target',
            'TrendingUp' => 'TrendingUp',
            'HandHeart' => 'HandHeart',
            'BookOpen' => 'BookOpen',
            'School' => 'School',
            'MedicalCross' => 'MedicalCross',
        ];
    }
}