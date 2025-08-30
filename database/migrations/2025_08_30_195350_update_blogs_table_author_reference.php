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
        Schema::table('blogs', function (Blueprint $table) {
            // Önce eski foreign key constraint'i kaldır
            $table->dropForeign(['author_id']);
            
            // author_id'yi authors tablosuna referans verecek şekilde güncelle
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Geri al
            $table->dropForeign(['author_id']);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade')->change();
        });
    }
};
