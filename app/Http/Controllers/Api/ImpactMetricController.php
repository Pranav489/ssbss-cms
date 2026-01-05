<?php

namespace App\Http\Controllers\Api;

use App\Models\ImpactMetric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpactMetricController extends Controller
{
    public function index()
    {
        $metrics = ImpactMetric::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'icon', 'number', 'label', 'description', 'image_path', 'image_alt', 'project_link', 'show_image', 'highlight']);
        
        return response()->json([
            'success' => true,
            'data' => $metrics,
            'count' => $metrics->count()
        ]);
    }
    
    public function highlighted()
    {
        $metrics = ImpactMetric::where('is_active', true)
            ->where('highlight', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get(['id', 'icon', 'number', 'label', 'description', 'image_path', 'project_link', 'highlight']);
        
        return response()->json([
            'success' => true,
            'data' => $metrics
        ]);
    }
}