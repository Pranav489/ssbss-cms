<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            // Header Section
            $table->text('header_description');
            
            // Header Stats
            $table->json('header_stats')->nullable();
            
            // About Content
            $table->text('about_content');
            $table->string('about_image_path')->nullable();
            $table->string('about_image_alt')->nullable();
            
            // Registrations & Certifications
            $table->json('registrations')->nullable();
            
            // Objectives
            $table->json('objectives')->nullable();
            
            // Projects
            $table->json('projects')->nullable();
            
            // Team Members
            $table->json('team_members')->nullable();
            
            // Settings
            $table->boolean('show_registrations')->default(true);
            $table->boolean('show_objectives')->default(true);
            $table->boolean('show_projects')->default(true);
            $table->boolean('show_team')->default(true);
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};