<?php

namespace App\Http\Controllers\Api;

use App\Models\GalleryImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryImage::active();
        
        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Get featured images
        if ($request->has('featured') && $request->featured) {
            $query->featured();
        }
        
        $images = $query->orderBy('sort_order')
            ->get(['id', 'title', 'image_path', 'image_alt', 'description', 'category', 'featured']);
        
        // Get all categories with counts
        $categories = GalleryImage::active()
            ->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->mapWithKeys(function ($item) {
                $availableCategories = GalleryImage::availableCategories();
                $categoryName = $availableCategories[$item->category] ?? $item->category;
                return [$item->category => [
                    'name' => $categoryName,
                    'count' => $item->count,
                ]];
            });
        
        // Add 'all' category
        $totalImages = GalleryImage::active()->count();
        $categories['all'] = [
            'name' => 'All Images',
            'count' => $totalImages,
        ];
        
        return response()->json([
            'success' => true,
            'data' => [
                'images' => $images,
                'categories' => $categories,
                'stats' => [
                    'total_images' => $totalImages,
                    'featured_images' => GalleryImage::active()->featured()->count(),
                    'categories_count' => count($categories) - 1, // Subtract 'all'
                ]
            ]
        ]);
    }
    
    public function featured()
    {
        $images = GalleryImage::active()
            ->featured()
            ->orderBy('sort_order')
            ->limit(6)
            ->get(['id', 'title', 'image_path', 'image_alt', 'description']);
        
        return response()->json([
            'success' => true,
            'data' => $images
        ]);
    }
    
    public function categories()
    {
        $categories = GalleryImage::active()
            ->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->map(function ($item) {
                $availableCategories = GalleryImage::availableCategories();
                return [
                    'id' => $item->category,
                    'name' => $availableCategories[$item->category] ?? $item->category,
                    'count' => $item->count,
                ];
            });
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}