<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;

class UpdateDocumentSizes extends Command
{
    protected $signature = 'documents:update-sizes';
    protected $description = 'Update file sizes and types for existing documents';

    public function handle()
    {
        $documents = Document::all();
        
        foreach ($documents as $document) {
            $filePath = public_path('uploads/' . $document->file_path);
            
            if (file_exists($filePath)) {
                // Update file size
                $size = filesize($filePath);
                $document->file_size = $this->formatBytes($size);
                
                // Update file type from extension
                $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                $document->file_type = strtoupper($extension);
                
                // Update icon based on file type
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
                
                $document->save();
                $this->info("Updated: {$document->title} - Type: {$document->file_type}, Size: {$document->file_size}");
            } else {
                $this->error("File not found: {$document->file_path}");
            }
        }
        
        $this->info('Completed!');
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