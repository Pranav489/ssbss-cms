<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('category_icon')->nullable();
            $table->string('tagline')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_alt')->nullable();
            
            // Overview
            $table->json('overview')->nullable(); // Array of paragraphs
            
            // Images
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();
            
            // Location
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->string('coordinates')->nullable();
            $table->text('google_maps_embed')->nullable();
            
            // Registration
            $table->string('registration_number')->nullable();
            $table->string('registration_authority')->nullable();
            $table->json('highlights')->nullable(); // Array
            
            // Statistics
            $table->json('hero_stats')->nullable(); // [{value: "275+", label: "Children Reached"}]
            $table->json('statistics')->nullable(); // Same structure
            
            // Sections
            $table->json('categories')->nullable(); // [{title, description, icon_emoji, eligibility}]
            $table->string('categories_title')->nullable();
            $table->text('categories_description')->nullable();
            
            $table->json('services')->nullable(); // [{title, description, details, icon, color, eligibility}]
            $table->string('services_title')->nullable();
            $table->text('services_description')->nullable();
            
            $table->json('process_steps')->nullable(); // [{step_number, title, description, duration}]
            $table->string('process_title')->nullable();
            $table->text('process_description')->nullable();
            $table->text('process_note')->nullable();
            
            // Documents
            $table->json('required_documents')->nullable(); // Array of strings
            $table->text('documents_note')->nullable();
            
            // Success stories
            $table->json('success_stories')->nullable(); // [{title, description, benefit, image_url, alt}]
            
            // Gallery
            $table->json('gallery')->nullable(); // [{url, alt, caption}]
            $table->string('gallery_title')->nullable();
            $table->text('gallery_description')->nullable();
            
            // Contact
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_hours')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_pages');
    }
};