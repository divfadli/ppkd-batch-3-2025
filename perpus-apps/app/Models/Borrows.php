<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    protected $fillable = [
        'anggota_id',
        'trans_number',
        'return_date',
        'note',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Members::class, 'anggota_id', 'id');
    }

    public function detailBorrows()
    {
        return $this->hasMany(DetailBorrows::class, 'borrows_id', 'id');
    }
}
