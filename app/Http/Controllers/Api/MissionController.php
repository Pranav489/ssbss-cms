<?php

namespace App\Http\Controllers\Api;

use App\Models\Mission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $mission = Mission::where('is_active', true)->first();
        
        if (!$mission) {
            return response()->json([
                'success' => false,
                'message' => 'Mission section not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'heading' => $mission->heading,
                'content' => $mission->content,
                'quick_stats' => $mission->quick_stats ?? [],
                'districts_covered' => $mission->getDistrictsArray(),
                'image_path' => $mission->image_path,
                'image_alt' => $mission->image_alt,
            ]
        ]);
    }
}