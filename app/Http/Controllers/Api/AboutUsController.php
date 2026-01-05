<?php

namespace App\Http\Controllers\Api;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::where('is_active', true)->first();
        
        if (!$aboutUs) {
            return response()->json([
                'success' => false,
                'message' => 'About Us page not found'
            ], 404);
        }
        
        // Process data for frontend
        $data = [
            'header' => [
                'description' => $aboutUs->header_description,
                'stats' => $aboutUs->header_stats ?? [],
            ],
            'about' => [
                'content' => $aboutUs->about_content,
                'image_path' => $aboutUs->about_image_path,
                'image_alt' => $aboutUs->about_image_alt,
            ],
            'sections' => [
                'registrations' => $aboutUs->show_registrations ? [
                    'enabled' => true,
                    'data' => $aboutUs->registrations ?? [],
                ] : ['enabled' => false],
                'objectives' => $aboutUs->show_objectives ? [
                    'enabled' => true,
                    'data' => $aboutUs->objectives ?? [],
                ] : ['enabled' => false],
                'projects' => $aboutUs->show_projects ? [
                    'enabled' => true,
                    'data' => $aboutUs->projects ?? [],
                ] : ['enabled' => false],
                'team' => $aboutUs->show_team ? [
                    'enabled' => true,
                    'data' => $aboutUs->team_members ?? [],
                ] : ['enabled' => false],
            ],
            'summary' => [
                'stats_count' => count($aboutUs->header_stats ?? []),
                'registrations_count' => count($aboutUs->registrations ?? []),
                'objectives_count' => count($aboutUs->objectives ?? []),
                'projects_count' => count($aboutUs->projects ?? []),
                'team_count' => count($aboutUs->team_members ?? []),
            ],
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}