<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'guest_name', 'guest_email', 'guest_phone', 'guest_note', 'guest_room_number', 'guest_check_in', 'guest_check_out', 'room_id', 'reservation_number', 'guest_status', 'guest_id_card', 'guest_qty', 'isOnline', 'isReserve', 'sub_total', 'tax', 'total_amount', 'payment_method', 'total_night'
    ];
    protected $append = ['isReserved_text', 'isReserved_class'];

    public function getIsReservedClassAttribute()
    {
        $classes = [
            '1' => "badge text-bg-success",
            '2' => "badge text-bg-secondary",
        ];

        return $classes[$this->isReserve] ?? "badge text-bg-warning";
    }

    public function getIsReservedTextAttribute()
    {
        $texts = [
            '1' => "Confirm",
            '2' => "Cancel",
        ];

        return $texts[$this->isReserve] ?? "Pending";
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'id');
    }
}