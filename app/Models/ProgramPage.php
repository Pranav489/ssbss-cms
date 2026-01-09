<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramPage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'category_icon',
        'tagline',
        'hero_image',
        'hero_alt',
        'overview',
        'location',
        'address',
        'coordinates',
        'registration_number',
        'registration_authority',
        'highlights',
        'hero_stats',
        'statistics',
        'categories',
        'services',
        'process_steps',
        'success_stories',
        'gallery',
        'categories_title',
        'categories_description',
        'services_title',
        'services_description',
        'process_title',
        'process_description',
        'process_note',
        'required_documents',
        'documents_note',
        'gallery_title',
        'gallery_description',
        'contact_title',
        'contact_description',
        'contact_phone',
        'contact_email',
        'contact_hours',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'highlights' => 'array',
        'hero_stats' => 'array',
        'statistics' => 'array',
        'categories' => 'array',
        'services' => 'array',
        'process_steps' => 'array',
        'success_stories' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
