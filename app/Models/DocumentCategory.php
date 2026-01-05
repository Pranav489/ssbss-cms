<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocumentCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Available icons for dropdown
    public static function availableIcons(): array
    {
        return [
            'FileText' => 'FileText',
            'BookOpen' => 'BookOpen',
            'Award' => 'Award',
            'Shield' => 'Shield',
            'FileSpreadsheet' => 'FileSpreadsheet',
            'FileCheck' => 'FileCheck',
            'FileType' => 'FileType',
            'File' => 'File',
            'FileArchive' => 'FileArchive',
            'FileImage' => 'FileImage',
            'FileVideo' => 'FileVideo',
            'Folder' => 'Folder',
            'FolderOpen' => 'FolderOpen',
        ];
    }

    // Relationships
    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }

    public function activeDocuments()
    {
        return $this->hasMany(Document::class, 'category_id')->where('is_active', true);
    }

    // Helper methods
    public function getDocumentsCountAttribute(): int
    {
        return $this->activeDocuments()->count();
    }
}