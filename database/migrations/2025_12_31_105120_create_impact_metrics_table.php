<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // Icon name for React component
            $table->string('number');
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('project_link'); // Project slug or URL
            $table->string('image_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_image')->default(true);
            $table->boolean('highlight')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_metrics');
    }
};