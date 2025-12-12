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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->morphs('reviewer');
            $table->text('review');
            $table->string('project_title')->nullable();
            $table->string('project_size')->nullable();
            $table->string('project_duration')->nullable();
            $table->text('project_summary')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->tinyInteger('quality')->nullable();
            $table->tinyInteger('schedule')->nullable();
            $table->tinyInteger('cost')->nullable();
            $table->tinyInteger('willing_to_refer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
