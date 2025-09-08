<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBorrows extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'borrows_id',
        'books_id',
    ];

    protected $date = ['deleted_at'];

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
