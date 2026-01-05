<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'file_type',
        'file_size',
        'file_path',
        'file_name',
        'icon',
        'upload_date',
        'download_count',
        'sort_order',
        'is_active',
        'featured'
    ];

    protected $casts = [
        'upload_date' => 'date',
        'download_count' => 'integer',
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

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
            'Download' => 'Download',
            'Eye' => 'Eye',
        ];
    }

    // Available file types
    public static function availableFileTypes(): array
    {
        return [
            'PDF' => 'PDF',
            'DOC' => 'Word Document',
            'DOCX' => 'Word Document',
            'XLS' => 'Excel',
            'XLSX' => 'Excel',
            'PPT' => 'PowerPoint',
            'PPTX' => 'PowerPoint',
            'JPG' => 'Image',
            'PNG' => 'Image',
            'ZIP' => 'Archive',
            'TXT' => 'Text',
        ];
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    // Helper methods
    public function getFileExtension(): string
    {
        return pathinfo($this->file_path, PATHINFO_EXTENSION);
    }

    public function getFormattedFileSize(): string
    {
        return $this->file_size ?: 'N/A';
    }

    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    // Get download URL
    public function getDownloadUrlAttribute(): string
    {
        return route('documents.download', ['document' => $this->id]);
    }
    public function getFileUrlAttribute(): string
    {
        if ($this->file_path) {
            return asset('uploads/' . $this->file_path);
        }
        return '';
    }

    // Get full path to the file
    public function getFullPathAttribute(): string
    {
        if ($this->file_path) {
            return public_path('uploads/' . $this->file_path);
        }
        return '';
    }

    // Check if file exists
    public function getFileExistsAttribute(): bool
    {
        return file_exists($this->full_path);
    }
    public function setFileNameAttribute($value)
    {
        // If file_name is provided without extension and we have a file_path
        if ($value && !str_contains($value, '.') && $this->file_path) {
            $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
            $value .= '.' . $extension;
        }
        
        $this->attributes['file_name'] = $value;
    }

    // Accessor for safe download name
    public function getSafeDownloadNameAttribute(): string
    {
        if ($this->file_name) {
            // Check if file_name has extension
            if (!str_contains($this->file_name, '.')) {
                $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
                return $this->file_name . '.' . $extension;
            }
            return $this->file_name;
        }
        
        return basename($this->file_path);
    }

    // Accessor for file_size with proper formatting
    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'N/A';
        }
        
        // If file_size is already formatted (contains KB, MB, etc), return as is
        if (preg_match('/[a-zA-Z]$/', $this->file_size)) {
            return $this->file_size;
        }
        
        // If it's a number in bytes, format it
        if (is_numeric($this->file_size)) {
            return $this->formatBytes($this->file_size);
        }
        
        return $this->file_size;
    }
    public function getFileTypeAttribute($value)
    {
        // If we have a file_path, use its extension as the source of truth
        if ($this->file_path) {
            $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
            return strtoupper($extension);
        }
        
        return $value;
    }

    // Mutator to always set file_type from file extension
    public function setFileTypeAttribute($value)
    {
        // Always derive from file_path if available
        if ($this->file_path) {
            $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
            $this->attributes['file_type'] = strtoupper($extension);
        } else {
            $this->attributes['file_type'] = $value;
        }
    }

    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    
}