<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // general, donation, volunteer, partnership, other
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject')->nullable();
            $table->text('message');
            
            // Donation specific fields
            $table->string('donation_type')->nullable(); // one-time, monthly, sponsorship, in-kind
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('purpose')->nullable(); // general, shelter, adoption, outreach, education, medical
            
            // Status tracking
            $table->enum('status', ['pending', 'reviewed', 'contacted', 'resolved', 'spam'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            
            // Metadata
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('metadata')->nullable(); // Additional form data
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};