<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order');
        
        // Filter by category
        if ($request->has('category')) {
            $categorySlug = $request->get('category');
            if ($categorySlug !== 'all') {
                $category = DocumentCategory::where('slug', $categorySlug)->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            }
        }
        
        // Filter featured
        if ($request->has('featured')) {
            $query->where('featured', true);
        }
        
        $documents = $query->get([
            'id', 'title', 'description', 'category_id', 'file_type',
            'file_size', 'file_path', 'icon', 'upload_date', 'download_count',
            'featured'
        ]);
        
        // Get stats
        $totalDocuments = Document::where('is_active', true)->count();
        $totalCategories = DocumentCategory::where('is_active', true)->count();
        $featuredDocuments = Document::where('is_active', true)->where('featured', true)->count();
        
        return response()->json([
            'success' => true,
            'data' => $documents,
            'stats' => [
                'total_documents' => $totalDocuments,
                'total_categories' => $totalCategories,
                'featured_documents' => $featuredDocuments,
            ],
            'count' => $documents->count()
        ]);
    }
    
    public function show($id)
    {
        $document = Document::with('category')
            ->where('is_active', true)
            ->find($id);
        
        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $document
        ]);
    }
    
    public function download($id)
{
    $document = Document::where('is_active', true)->find($id);
    
    if (!$document) {
        return response()->json([
            'success' => false,
            'message' => 'Document not found'
        ], 404);
    }
    
    // Check if file exists in uploads directory
    $filePath = public_path('uploads/' . $document->file_path);
    
    if (!file_exists($filePath)) {
        return response()->json([
            'success' => false,
            'message' => 'File not found on server'
        ], 404);
    }
    
    // Get file extension
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    
    // Set proper content type based on file extension
    $contentTypes = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'zip' => 'application/zip',
        'txt' => 'text/plain',
    ];
    
    $contentType = $contentTypes[strtolower($extension)] ?? 'application/octet-stream';
    
    // Increment download count
    $document->increment('download_count');
    
    $fileName = $document->file_name ?: basename($document->file_path);
    
    // Return file with proper headers
    return response()->download(
        $filePath,
        $fileName,
        [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]
    );
}

public function trackDownload($id)
{
    $document = Document::find($id);
    
    if ($document) {
        $document->increment('download_count');
        
        return response()->json([
            'success' => true,
            'message' => 'Download tracked',
            'download_count' => $document->download_count
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'Document not found'
    ], 404);
}
}