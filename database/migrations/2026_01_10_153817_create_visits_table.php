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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();

            $table->string('visitor_id')->nullable()->index();
            $table->ipAddress('ip_address')->index();
            $table->text('user_agent');
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('device_type')->nullable();
            $table->text('page_url')->nullable();
            $table->text('referrer_url')->nullable();

            $table->string('country_code', 2)->nullable()->index();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();

            $table->timestamps();

            $table->index(['company_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
