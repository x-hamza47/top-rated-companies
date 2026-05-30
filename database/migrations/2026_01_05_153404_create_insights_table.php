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
        Schema::create('insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('author_id')->nullable()->constrained('authors')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();

            $table->text('excerpt')->nullable(); 

            $table->string('thumbnail')->nullable();

            $table->timestamp('published_at')->nullable();

            $table->integer('read_time')->nullable();

            $table->longText('content_json')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insights');
    }
};
