<?php

namespace App\Http\Controllers\Api;

use App\Models\JoinMission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JoinMissionController extends Controller
{
    public function index()
    {
        $joinMission = JoinMission::where('is_active', true)->first();
        
        if (!$joinMission) {
            return response()->json([
                'success' => false,
                'message' => 'Join Our Mission section not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'statement' => $joinMission->statement,
                'image_path' => $joinMission->image_path,
                'image_alt' => $joinMission->image_alt,
                'children_helped' => $joinMission->children_helped,
                'families_reunited' => $joinMission->families_reunited,
                'lives_changed' => $joinMission->lives_changed,
                'stats' => $joinMission->getStatsAttribute(),
                'formatted_stats' => [
                    'children_helped' => number_format($joinMission->children_helped),
                    'families_reunited' => number_format($joinMission->families_reunited),
                    'lives_changed' => number_format($joinMission->lives_changed),
                ]
            ]
        ]);
    }
}