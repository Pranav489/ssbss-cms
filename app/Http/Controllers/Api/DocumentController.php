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
        
        // Check if file exists
        $filePath = public_path('uploads/' . $document->file_path);
        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found on server'
            ], 404);
        }
        
        // Increment download count
        $document->incrementDownloadCount();
        
        $fileName = $document->file_name ?: basename($document->file_path);
        
        return response()->download($filePath, $fileName);
    }
}