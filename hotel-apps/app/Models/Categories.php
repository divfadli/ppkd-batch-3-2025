<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name', 'slug'];
    // protected $table = 'categorie'; //Jika nama tabel pada database tidak pakai 's' dibelakangnya
}