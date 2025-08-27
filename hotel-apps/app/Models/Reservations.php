<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'guest_name', 'guest_email', 'guest_phone', 'guest_note', 'guest_room_number', 'guest_check_in', 'guest_check_out', 'room_id', 'reservation_number', 'guest_status', 'guest_id_card', 'guest_qty', 'isOnline', 'isReserve', 'sub_total', 'tax', 'total_amount', 'payment_method', 'total_night'
    ];
}