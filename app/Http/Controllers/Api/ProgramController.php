<?php

namespace App\Http\Controllers\Api;

use App\Models\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->get([
                'id', 'title', 'subtitle', 'description', 'icon', 
                'image_path', 'image_alt', 'features', 'stats', 'cta_link',
                'featured'
            ]);
        
        return response()->json([
            'success' => true,
            'data' => $programs,
            'count' => $programs->count()
        ]);
    }
    
    public function featured()
    {
        $programs = Program::where('is_active', true)
            ->where('featured', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get(['id', 'title', 'subtitle', 'description', 'icon', 'image_path', 'cta_link']);
        
        return response()->json([
            'success' => true,
            'data' => $programs
        ]);
    }
    
    public function show($slug)
    {
        $program = Program::where('cta_link', $slug)
            ->where('is_active', true)
            ->first();
        
        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program not found'
            ], 404);
        }
        
        // Increment views or add analytics here if needed
        
        return response()->json([
            'success' => true,
            'data' => $program
        ]);
    }
}