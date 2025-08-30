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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            // category_id'yi sonra ekleyeceğiz
            // $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            // SEO için slug
            $table->string('slug')->unique();
            
            // Arama için index
            $table->index(['title', 'content']);
            $table->index('status');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
