<?php

namespace App\Http\Controllers\Api;

use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        $categories = DocumentCategory::withCount(['documents' => function ($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get(['id', 'name', 'slug', 'icon', 'description']);
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}