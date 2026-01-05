<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_form_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_form_id')->constrained()->onDelete('cascade');
            $table->text('response');
            $table->foreignId('admin_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_form_responses');
    }
};