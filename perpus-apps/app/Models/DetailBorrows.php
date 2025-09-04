<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBorrows extends Model
{
    protected $fillable = [
        'borrows_id',
        'books_id',
    ];

    // relation orm ke table Borrows
    public function borrow()
    {
        return $this->belongsTo(Borrows::class, 'borrows_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'books_id', 'id');
    }
}
