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
 Schema::table('reservations', function (Blueprint $table) {
            $table->string('guest_room_number', 50)->after('guest_qty')->nullable();
            $table->string('payment_method', 20)->after('isReserve')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['guest_room_number', 'payment_method']);
        });
    }
};