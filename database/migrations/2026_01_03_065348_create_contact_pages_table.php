<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            // Headquarters
            $table->string('headquarters_title')->default('Headquarters');
            $table->text('headquarters_address');
            $table->string('headquarters_phone');
            $table->string('headquarters_email');
            $table->string('headquarters_hours');
            
            // Centers
            $table->json('centers')->nullable(); // [{name, location, phone, email, icon}]
            
            // Emergency Contact
            $table->string('emergency_title')->default('Emergency Contact');
            $table->string('child_helpline');
            $table->string('whatsapp_number');
            $table->string('emergency_email');
            $table->text('emergency_note')->nullable();
            
            // Form Settings
            $table->string('form_title')->default('Get In Touch');
            $table->text('form_description')->nullable();
            $table->string('general_form_title')->default('General Inquiry');
            $table->string('donation_form_title')->default('Donation Inquiry');
            
            // Quick Actions
            $table->json('quick_actions')->nullable(); // [{label, icon, type, value}]
            
            // Map
            $table->string('map_title')->default('Find Us');
            $table->text('google_maps_embed')->nullable();
            $table->string('coordinates')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};