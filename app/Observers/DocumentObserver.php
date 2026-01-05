<?php

namespace App\Observers;

use App\Models\Document;

class DocumentObserver
{
    public function saving(Document $document)
    {
        // Calculate file size if not set and file exists
        if (empty($document->file_size) && $document->file_path) {
            $filePath = public_path('uploads/' . $document->file_path);
            if (file_exists($filePath)) {
                $size = filesize($filePath);
                $document->file_size = $this->formatBytes($size);
            }
        }
        
        // Ensure file_type is set from file extension
        if ($document->file_path) {
            $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
            $document->file_type = strtoupper($extension);
        }
        
        // Ensure icon is set based on file extension
        if (empty($document->icon) && $document->file_path) {
            $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
            $icons = [
                'pdf' => 'FileText',
                'doc' => 'FileText',
                'docx' => 'FileText',
                'xls' => 'FileSpreadsheet',
                'xlsx' => 'FileSpreadsheet',
                'ppt' => 'File',
                'pptx' => 'File',
                'jpg' => 'FileImage',
                'jpeg' => 'FileImage',
                'png' => 'FileImage',
                'zip' => 'FileArchive',
                'txt' => 'FileText',
            ];
            $document->icon = $icons[strtolower($extension)] ?? 'File';
        }
        
        // Ensure file_name has extension if missing
        if ($document->file_name && !str_contains($document->file_name, '.') && $document->file_path) {
            $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
            $document->file_name .= '.' . $extension;
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