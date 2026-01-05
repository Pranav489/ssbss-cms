<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'category_icon',
        'tagline',
        'hero_image',
        'hero_alt',
        'overview',
        'featured_image',
        'featured_image_alt',
        'location',
        'address',
        'coordinates',
        'google_maps_embed',
        'registration_number',
        'registration_authority',
        'highlights',
        'hero_stats',
        'statistics',
        'categories',
        'categories_title',
        'categories_description',
        'services',
        'services_title',
        'services_description',
        'process_steps',
        'process_title',
        'process_description',
        'process_note',
        'required_documents',
        'documents_note',
        'success_stories',
        'gallery',
        'gallery_title',
        'gallery_description',
        'contact_title',
        'contact_description',
        'contact_phone',
        'contact_email',
        'contact_hours',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'overview' => 'array',
        'highlights' => 'array',
        'hero_stats' => 'array',
        'statistics' => 'array',
        'categories' => 'array',
        'services' => 'array',
        'process_steps' => 'array',
        'required_documents' => 'array',
        'success_stories' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
{
    parent::boot();

    static::saving(function ($model) {
        // Ensure JSON fields are properly encoded
        $jsonFields = [
            'overview', 'highlights', 'hero_stats', 'statistics',
            'categories', 'services', 'process_steps', 'required_documents',
            'success_stories', 'gallery'
        ];
        
        foreach ($jsonFields as $field) {
            if (is_null($model->$field)) {
                $model->$field = json_encode([]);
            }
        }
    });
}
public function getOverviewAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getHeroStatsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getStatisticsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getHighlightsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getCategoriesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getServicesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getProcessStepsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getRequiredDocumentsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getSuccessStoriesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    public function getGalleryAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?? [];
    }

    // Add mutators to ensure JSON encoding
    public function setOverviewAttribute($value)
    {
        $this->attributes['overview'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setHeroStatsAttribute($value)
    {
        $this->attributes['hero_stats'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setStatisticsAttribute($value)
    {
        $this->attributes['statistics'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setHighlightsAttribute($value)
    {
        $this->attributes['highlights'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setCategoriesAttribute($value)
    {
        $this->attributes['categories'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setServicesAttribute($value)
    {
        $this->attributes['services'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setProcessStepsAttribute($value)
    {
        $this->attributes['process_steps'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setRequiredDocumentsAttribute($value)
    {
        $this->attributes['required_documents'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setSuccessStoriesAttribute($value)
    {
        $this->attributes['success_stories'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setGalleryAttribute($value)
    {
        $this->attributes['gallery'] = is_array($value) ? json_encode($value) : $value;
    }

    // Available program categories
    public static function availableCategories(): array
    {
        return [
            'shelter' => 'Shelter Home',
            'adoption' => 'Adoption Agency',
            'outreach' => 'Outreach Program',
            'welfare' => 'Welfare Scheme',
            'education' => 'Education Program',
            'medical' => 'Medical Services',
            'counseling' => 'Counseling Services',
            'legal' => 'Legal Aid',
        ];
    }

    // Available category icons
    public static function availableCategoryIcons(): array
    {
        return [
            'Home' => 'Home',
            'Heart' => 'Heart',
            'Users' => 'Users',
            'Shield' => 'Shield',
            'BookOpen' => 'BookOpen',
            'MedicalCross' => 'MedicalCross',
            'MessageCircle' => 'MessageCircle',
            'Scale' => 'Scale',
            'Child' => 'Child',
            'Bed' => 'Bed',
            'HandHeart' => 'HandHeart',
            'Star' => 'Star',
        ];
    }

    // Available service icons
    public static function availableServiceIcons(): array
    {
        return [
            'Home' => 'Home',
            'Heart' => 'Heart',
            'Users' => 'Users',
            'Shield' => 'Shield',
            'BookOpen' => 'BookOpen',
            'MedicalCross' => 'MedicalCross',
            'MessageCircle' => 'MessageCircle',
            'Scale' => 'Scale',
            'Child' => 'Child',
            'Bed' => 'Bed',
            'Utensils' => 'Utensils',
            'School' => 'School',
            'FileText' => 'FileText',
            'Calendar' => 'Calendar',
            'Phone' => 'Phone',
            'Mail' => 'Mail',
        ];
    }

    // Available colors for services
    public static function availableServiceColors(): array
    {
        return [
            'blue' => 'Blue',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'purple' => 'Purple',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
            'teal' => 'Teal',
            'orange' => 'Orange',
            'gray' => 'Gray',
        ];
    }

    // Get full URL for hero image
    public function getHeroImageUrlAttribute(): string
    {
        if ($this->hero_image) {
            return asset('uploads/program-pages/' . $this->hero_image);
        }
        return '';
    }

    // Get full URL for featured image
    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('uploads/program-pages/' . $this->featured_image);
        }
        return '';
    }

    // Scope for active program pages
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Generate Google Maps link from coordinates
    public function getGoogleMapsLinkAttribute(): string
    {
        if ($this->coordinates) {
            return "https://www.google.com/maps/search/?api=1&query={$this->coordinates}";
        }
        return '';
    }

}