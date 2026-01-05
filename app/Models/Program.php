<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'icon',
        'image_alt',
        'features',
        'stats',
        'cta_link',
        'image_path',
        'sort_order',
        'is_active',
        'featured'
    ];

    protected $casts = [
        'features' => 'array',
        'stats' => 'array',
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->cta_link)) {
                $program->cta_link = Str::slug($program->title);
            }
        });

        static::updating(function ($program) {
            if (empty($program->cta_link)) {
                $program->cta_link = Str::slug($program->title);
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
            'Child' => 'Child',
            'BookOpen' => 'BookOpen',
            'School' => 'School',
            'MedicalCross' => 'MedicalCross',
            'HeartHandshake' => 'HeartHandshake',
            'HandHeart' => 'HandHeart',
            'Users2' => 'Users2',
            'Building' => 'Building',
            'Bed' => 'Bed',
            'Utensils' => 'Utensils',
            'Book' => 'Book',
            'Star' => 'Star',
        ];
    }

    // Helper methods
    public function getFullCtaLinkAttribute(): string
    {
        return "programs/{$this->cta_link}";
    }

    public function getFeaturesListAttribute(): array
    {
        return $this->features ?? [];
    }

    public function getStatsListAttribute(): array
    {
        return $this->stats ?? [];
    }
}