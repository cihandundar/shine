<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Blogs tablosuna yayınlanma tarihi alanı ekliyoruz
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Yayınlanma tarihi alanı ekliyoruz (published_at'den farklı olarak)
            $table->date('published_date')->nullable()->after('published_at');
            
            // Yayınlanma tarihi için index ekliyoruz
            $table->index('published_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['published_date']);
            $table->dropColumn('published_date');
        });
    }
};
