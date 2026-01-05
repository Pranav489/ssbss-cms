<?php

namespace App\Http\Controllers\Api;

use App\Models\ProgramPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramPageController extends Controller
{
    public function index()
    {
        $programPages = ProgramPage::active()
            ->orderBy('sort_order')
            ->get();
        
        // Transform data for React
        $transformed = $programPages->map(function ($page) {
            return [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'category' => $page->category,
                'category_icon' => $page->category_icon,
                'tagline' => $page->tagline,
                'hero_image' => $page->hero_image_url,
                'hero_alt' => $page->hero_alt,
                'location' => $page->location,
                'is_active' => $page->is_active,
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $transformed
        ]);
    }
    
    public function show($slug)
    {
        $programPage = ProgramPage::where('slug', $slug)
            ->where('is_active', true)
            ->first();
        
        if (!$programPage) {
            return response()->json([
                'success' => false,
                'message' => 'Program page not found'
            ], 404);
        }
        
        // Process data for React frontend
        $data = [
            'id' => $programPage->id,
            'title' => $programPage->title,
            'slug' => $programPage->slug,
            'tagline' => $programPage->tagline,
            'category' => $programPage->category,
            'category_icon' => $programPage->category_icon,
            'hero' => [
                'image' => $programPage->hero_image_url,
                'alt' => $programPage->hero_alt,
                'stats' => $programPage->hero_stats ?? [],
            ],
            'overview' => $programPage->overview ?? [],
            'location' => [
                'name' => $programPage->location,
                'address' => $programPage->address,
                'coordinates' => $programPage->coordinates,
                'google_maps_embed' => $programPage->google_maps_embed,
                'google_maps_link' => $programPage->google_maps_link,
            ],
            'registration' => [
                'number' => $programPage->registration_number,
                'authority' => $programPage->registration_authority,
                'highlights' => $programPage->highlights ?? [],
            ],
            'statistics' => $programPage->statistics ?? [],
            'categories' => [
                'title' => $programPage->categories_title ?? 'Categories',
                'description' => $programPage->categories_description,
                'items' => $programPage->categories ?? [],
            ],
            'services' => [
                'title' => $programPage->services_title ?? 'Our Services',
                'description' => $programPage->services_description,
                'items' => $programPage->services ?? [],
            ],
            'process' => [
                'title' => $programPage->process_title ?? 'How It Works',
                'description' => $programPage->process_description,
                'note' => $programPage->process_note,
                'steps' => $programPage->process_steps ?? [],
            ],
            'documents' => [
                'required' => $programPage->required_documents ?? [],
                'note' => $programPage->documents_note,
            ],
            'success_stories' => $programPage->success_stories ?? [],
            'gallery' => [
                'title' => $programPage->gallery_title ?? 'Gallery',
                'description' => $programPage->gallery_description,
                'images' => $programPage->gallery ?? [],
            ],
            'contact' => [
                'title' => $programPage->contact_title ?? 'Contact Us',
                'description' => $programPage->contact_description,
                'phone' => $programPage->contact_phone,
                'email' => $programPage->contact_email,
                'hours' => $programPage->contact_hours,
            ],
            'featured_image' => [
                'url' => $programPage->featured_image_url,
                'alt' => $programPage->featured_image_alt,
            ],
            'is_active' => $programPage->is_active,
            'created_at' => $programPage->created_at,
            'updated_at' => $programPage->updated_at,
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    
    public function categories()
    {
        $categories = ProgramPage::active()
            ->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->map(function ($item) {
                $availableCategories = ProgramPage::availableCategories();
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