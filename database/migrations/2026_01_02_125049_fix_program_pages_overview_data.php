<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProgramPage;

return new class extends Migration
{
    public function up(): void
    {
        $programPages = ProgramPage::all();
        
        foreach ($programPages as $programPage) {
            $overview = $programPage->overview;
            
            if (is_string($overview) && $overview) {
                // Try to decode
                $decoded = json_decode($overview, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    // Already valid JSON
                    // Check if it's the old format (array of strings)
                    if (isset($decoded[0]) && is_string($decoded[0])) {
                        // Convert to new format (array of objects with paragraph key)
                        $newOverview = [];
                        foreach ($decoded as $paragraph) {
                            $newOverview[] = ['paragraph' => $paragraph];
                        }
                        $programPage->overview = $newOverview;
                    }
                } else {
                    // Not JSON, treat as single paragraph
                    $programPage->overview = [['paragraph' => $overview]];
                }
                
                $programPage->save();
            }
        }
    }

    public function down(): void
    {
        // Optional: You can implement rollback if needed
    }
};