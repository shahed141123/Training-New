<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('parent_id')->nullable()->constrained('course_categories')->onDelete('cascade');
            $table->string('course_section_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('header')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('thumbnail_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
