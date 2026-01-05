<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HeroSlide extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'icon',
        'image_alt',
        'cta_link',
        'stats',
        'image_path',
        'sort_order',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($slide) {
            if (empty($slide->cta_link)) {
                $slide->cta_link = Str::slug($slide->title);
            }
        });

        static::updating(function ($slide) {
            if (empty($slide->cta_link)) {
                $slide->cta_link = Str::slug($slide->title);
            }
        });
    }

    // Available icons for dropdown
    public static function availableIcons(): array
    {
        return [
            'Heart' => 'Heart',
            'Home' => 'Home',
            'Users' => 'Users',
            'Shield' => 'Shield',
            'Star' => 'Star',
            'HandHeart' => 'HandHeart',
            'Child' => 'Child',
            'BookOpen' => 'BookOpen',
            'School' => 'School',
            'MedicalCross' => 'MedicalCross',
            'Utensils' => 'Utensils',
            'Bed' => 'Bed',
            'Users2' => 'Users2',
            'Smile' => 'Smile',
            'HeartHandshake' => 'HeartHandshake',
        ];
    }
}