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
        Schema::create('company_visit_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->date('date');
 
            $table->unsignedInteger('total_visits')->default(0);
            $table->unsignedInteger('unique_visitors')->default(0);
 
            $table->json('devices')->nullable();    // { "mobile": 120, "desktop": 80 }
            $table->json('browsers')->nullable();   // { "Chrome": 100, "Safari": 50 }
            $table->json('countries')->nullable();  // { "PK": 80, "US": 40 }
            $table->json('referrers')->nullable();  // { "google.com": 60, "direct": 40 }
            $table->json('hours')->nullable();      // { "0": 5, "8": 40, "14": 80 }
 
            $table->timestamps();
 
            $table->unique(['company_id', 'date']);
            $table->index(['company_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_visit_summaries');
    }
};
