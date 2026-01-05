<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'image_alt',
        'description',
        'category',
        'sort_order',
        'is_active',
        'featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    // Available categories for dropdown
    public static function availableCategories(): array
    {
        return [
            'activities' => 'Activities & Events',
            'facilities' => 'Facilities',
            'children' => 'Children',
            'team' => 'Team',
            'projects' => 'Projects',
            'outreach' => 'Community Outreach',
            'education' => 'Education',
            'medical' => 'Medical Care',
            'recreation' => 'Recreation',
            'general' => 'General',
        ];
    }

    // Scope for active images
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured images
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Get full URL for the image
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            return asset('uploads/' . $this->image_path);
        }
        return '';
    }

    // Get thumbnail URL (you could implement thumbnail generation logic)
    public function getThumbnailUrlAttribute(): string
    {
        // For now, return the same image
        // In production, you could use intervention/image to create thumbnails
        return $this->image_url;
    }
}