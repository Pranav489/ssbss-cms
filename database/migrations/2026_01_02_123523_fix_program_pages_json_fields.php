<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProgramPage;

return new class extends Migration
{
    public function up(): void
    {
        // Get all program pages
        $programPages = ProgramPage::all();
        
        foreach ($programPages as $programPage) {
            // Fix each JSON field
            $jsonFields = [
                'overview',
                'highlights',
                'hero_stats',
                'statistics',
                'categories',
                'services',
                'process_steps',
                'required_documents',
                'success_stories',
                'gallery',
            ];
            
            foreach ($jsonFields as $field) {
                $value = $programPage->$field;
                
                if (is_string($value) && $value !== null) {
                    // Try to decode
                    $decoded = json_decode($value, true);
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                        // Already valid JSON, keep it
                        continue;
                    } else {
                        // Not valid JSON, make it an empty array
                        $programPage->$field = json_encode([]);
                    }
                } elseif ($value === null) {
                    // Null value, make it empty array
                    $programPage->$field = json_encode([]);
                }
            }
            
            $programPage->save();
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
};