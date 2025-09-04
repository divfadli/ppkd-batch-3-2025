<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'location_id',
        'category_id',
        'title',
        'author',
        'publisher',
        'date_publication',
        'description',
        'stock'
    ];

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
