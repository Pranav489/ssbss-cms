<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationSetting extends Model
{
    protected $table = 'donation_settings';

    protected $fillable = [
        'title',
        'description',
        'hero_image',
        'bank_accounts',
        'donation_options',
        'certifications',
        'impact_stats',
        'instructions',
        'is_active',
    ];

    protected $casts = [
        'bank_accounts' => 'array',
        'donation_options' => 'array',
        'certifications' => 'array',
        'impact_stats' => 'array',
        'instructions' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper to get the active donation setting
    public static function getActive()
    {
        return self::active()->first();
    }
}