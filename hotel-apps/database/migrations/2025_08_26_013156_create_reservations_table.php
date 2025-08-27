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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('reservation_number', 50)->unique();
            $table->string('guest_name');
            $table->string('guest_email',50)->nullable();
            $table->string('guest_phone',15)->nullable();
            $table->string('guest_status',50)->nullable();
            $table->string('guest_id_card',100)->nullable();
            $table->string('guest_qty',10)->nullable();
            $table->string('total_night');
            $table->string('guest_room_number',50);
            $table->date('guest_check_in');
            $table->date('guest_check_out');
            $table->text('guest_note')->nullable();
            $table->tinyInteger('isOnline')->default(0)->nullable();
            $table->tinyInteger('isReserve')->default(0)->nullable();
            $table->string('payment_method',20);
            $table->decimal('sub_total',8,2);
            $table->decimal('tax', 15,2)->after('sub_total');
            $table->decimal('total_amount',15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};