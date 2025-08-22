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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name_guest');
            $table->date('check_in');
            $table->date('check_out');
            $table->string("number_room");
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('status_guest');
            $table->string('address');
            $table->string("special_needs")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};