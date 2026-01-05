<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing records to have proper JSON arrays
        DB::table('program_pages')->whereNull('overview')->update(['overview' => '[]']);
        DB::table('program_pages')->whereNull('hero_stats')->update(['hero_stats' => '[]']);
        DB::table('program_pages')->whereNull('statistics')->update(['statistics' => '[]']);
        DB::table('program_pages')->whereNull('highlights')->update(['highlights' => '[]']);
        DB::table('program_pages')->whereNull('categories')->update(['categories' => '[]']);
        DB::table('program_pages')->whereNull('services')->update(['services' => '[]']);
        DB::table('program_pages')->whereNull('process_steps')->update(['process_steps' => '[]']);
        DB::table('program_pages')->whereNull('required_documents')->update(['required_documents' => '[]']);
        DB::table('program_pages')->whereNull('success_stories')->update(['success_stories' => '[]']);
        DB::table('program_pages')->whereNull('gallery')->update(['gallery' => '[]']);
    }

    public function down(): void
    {
        // No rollback needed
    }
};