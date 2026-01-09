<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramPage;
use Illuminate\Http\Request;

class ProgramPageController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramPage::active()->ordered();
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('tagline', 'like', '%' . $request->search . '%')
                  ->orWhere('overview', 'like', '%' . $request->search . '%');
            });
        }
        
        $perPage = $request->get('per_page', 10);
        $programPages = $query->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $programPages,
            'message' => 'Program pages retrieved successfully.'
        ]);
    }
    
    public function show($slug)
    {
        $programPage = ProgramPage::where('slug', $slug)->active()->first();
        
        if (!$programPage) {
            return response()->json([
                'success' => false,
                'message' => 'Program page not found.'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $programPage,
            'message' => 'Program page retrieved successfully.'
        ]);
    }
    
    public function byCategory($category)
    {
        $programPages = ProgramPage::where('category', $category)
            ->active()
            ->ordered()
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $programPages,
            'message' => 'Program pages by category retrieved successfully.'
        ]);
    }
    
    public function featured()
    {
        $programPages = ProgramPage::active()
            ->ordered()
            ->limit(6)
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $programPages,
            'message' => 'Featured program pages retrieved successfully.'
        ]);
    }
}
