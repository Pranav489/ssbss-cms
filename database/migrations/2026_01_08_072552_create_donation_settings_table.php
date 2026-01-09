<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('hero_image')->nullable();
            $table->json('bank_accounts')->nullable(); // JSON array of bank accounts
            $table->json('donation_options')->nullable(); // JSON array of donation options
            $table->json('certifications')->nullable(); // JSON array of certifications
            $table->json('impact_stats')->nullable(); // JSON impact statistics
            $table->json('instructions')->nullable(); // JSON array of instructions
            $table->boolean('is_active')->default(true);
           
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_settings');
    }
};