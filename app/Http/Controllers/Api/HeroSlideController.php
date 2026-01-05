<?php

namespace App\Http\Controllers\Api;

use App\Models\HeroSlide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'subtitle', 'description', 'icon', 'image_path', 'image_alt', 'cta_link', 'stats']);
        
        return response()->json([
            'success' => true,
            'data' => $slides
        ]);
    }
    
    public function show($slug)
    {
        $slide = HeroSlide::where('cta_link', $slug)
            ->where('is_active', true)
            ->first();
        
        if (!$slide) {
            return response()->json([
                'success' => false,
                'message' => 'Slide not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $slide
        ]);
    }
}