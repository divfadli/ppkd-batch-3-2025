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
        Schema::create('detail_borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrows_id')->constrained('borrows')->onDelete('cascade');
            $table->foreignId('books_id')->constrained('books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_borrows');
    }
};