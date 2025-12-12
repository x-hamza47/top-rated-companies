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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('min_project_size')->nullable();
            $table->decimal('hourly_rate_min', 8, 2)->nullable();
            $table->decimal('hourly_rate_max', 8, 2)->nullable();
            $table->integer('employees_min')->nullable();
            $table->integer('employees_max')->nullable();
            $table->string('locations')->nullable();
            $table->year('founded')->nullable();
            $table->json('languages')->nullable();
            $table->string('website')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
