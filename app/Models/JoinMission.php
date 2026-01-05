<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinMission extends Model
{
    protected $fillable = [
        'statement',
        'image_path',
        'image_alt',
        'children_helped',
        'families_reunited',
        'lives_changed',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Singleton pattern
    public static function getJoinMission()
    {
        return self::first() ?? new self();
    }

    // Get all stats as array for easy access
    public function getStatsAttribute(): array
    {
        return [
            [
                'label' => 'Children Helped',
                'value' => $this->children_helped,
                'suffix' => '+',
                'icon' => 'Child',
            ],
            [
                'label' => 'Families Reunited',
                'value' => $this->families_reunited,
                'suffix' => '+',
                'icon' => 'Home',
            ],
            [
                'label' => 'Lives Changed',
                'value' => $this->lives_changed,
                'suffix' => '+',
                'icon' => 'Heart',
            ],
        ];
    }

    // Get formatted numbers with commas
    public function getFormattedChildrenHelped(): string
    {
        return number_format($this->children_helped);
    }

    public function getFormattedFamiliesReunited(): string
    {
        return number_format($this->families_reunited);
    }

    public function getFormattedLivesChanged(): string
    {
        return number_format($this->lives_changed);
    }
}