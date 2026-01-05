<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'heading',
        'content',
        'quick_stats',
        'districts_covered',
        'image_path',
        'image_alt',
        'is_active'
    ];

    protected $casts = [
        'quick_stats' => 'array',
        'is_active' => 'boolean',
    ];

    // Singleton pattern - get the first (and only) record
    public static function getMission()
    {
        return self::first() ?? new self();
    }

    // Available quick stat icons
    public static function availableStatIcons(): array
    {
        return [
            'Users' => 'Users',
            'Heart' => 'Heart',
            'Home' => 'Home',
            'Shield' => 'Shield',
            'Target' => 'Target',
            'Star' => 'Star',
            'Award' => 'Award',
            'Calendar' => 'Calendar',
            'MapPin' => 'MapPin',
            'Child' => 'Child',
            'Users2' => 'Users2',
        ];
    }

    // Helper to get formatted districts
    public function getDistrictsArray(): array
    {
        if (empty($this->districts_covered)) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->districts_covered));
    }
}