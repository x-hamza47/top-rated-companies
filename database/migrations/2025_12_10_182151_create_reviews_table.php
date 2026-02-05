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

            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            //! Reviewer Details
            $table->string('reviewer_name');
            $table->string('reviewer_email');
            $table->string('reviewer_location')->nullable();
            $table->string('reviewer_company')->nullable();
            $table->text('reviewer_company_bio')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->string('reviewer_employees')->nullable();

            //! Service
            // TODO: Replace service_id with review_service pivot (multi-service reviews)
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();

            //! Review Content
            $table->string('review');
            $table->text('summary');

            //! Ratings
            $table->unsignedTinyInteger('rating');
            $table->unsignedTinyInteger('quality')->nullable();
            $table->unsignedTinyInteger('ai')->nullable();
            $table->unsignedTinyInteger('schedule')->nullable();
            $table->unsignedTinyInteger('cost')->nullable();
            $table->unsignedTinyInteger('willing_to_refer')->nullable();

            //! Project Details
            $table->string('project_title')->nullable();
            $table->string('project_size')->nullable();
            $table->string('project_duration')->nullable();
            $table->text('project_summary')->nullable();

            //! Analytics
            $table->enum('source', ['Topfirms', 'Google', 'Others'])->nullable();
            $table->string('reference')->nullable();
            $table->enum('status', ['unlisted', 'verified'])->default('unlisted');

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
