<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->enum('form_type', ['general', 'donation'])->default('general');
            $table->string('donation_type')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('purpose')->nullable();
            $table->enum('status', ['new', 'in_progress', 'resolved', 'spam'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};