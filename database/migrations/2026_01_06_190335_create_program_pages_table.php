<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('category_icon')->nullable();
            $table->string('tagline');
            $table->string('hero_image')->nullable();
            $table->string('hero_alt')->nullable();
            $table->text('overview');
            $table->string('location');
            $table->text('address')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('registration_authority')->nullable();
            
            // JSON fields for structured data
            $table->json('highlights')->nullable();
            $table->json('hero_stats')->nullable();
            $table->json('statistics')->nullable();
            $table->json('categories')->nullable();
            $table->json('services')->nullable();
            $table->json('process_steps')->nullable();
            $table->json('success_stories')->nullable();
            $table->json('gallery')->nullable();
            
            // Text fields
            $table->string('categories_title')->nullable();
            $table->text('categories_description')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_description')->nullable();
            $table->string('process_title')->nullable();
            $table->text('process_description')->nullable();
            $table->text('process_note')->nullable();
            $table->text('required_documents')->nullable();
            $table->text('documents_note')->nullable();
            $table->string('gallery_title')->nullable();
            $table->text('gallery_description')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            
            // Contact info
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_hours')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_pages');
    }
};