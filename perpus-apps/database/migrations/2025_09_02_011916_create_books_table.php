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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->date('date_publication')->nullable();
            $table->string('description')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};