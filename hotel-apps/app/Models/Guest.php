<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // protected $table = 'guests';
    protected $fillable = [
        'name_guest', 'check_in', 'check_out', 'number_room', 'email', 'phone', 'status_guest', 'address', 'special_needs',
    ];
}