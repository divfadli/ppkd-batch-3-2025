<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrows extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'anggota_id',
        'trans_number',
        'return_date',
        'note',
        'status'
    ];

    protected $date = ['deleted_at'];

    public function member()
    {
        return $this->belongsTo(Members::class, 'anggota_id', 'id');
    }

    public function detailBorrows()
    {
        return $this->hasMany(DetailBorrows::class, 'borrows_id', 'id');
    }
}
