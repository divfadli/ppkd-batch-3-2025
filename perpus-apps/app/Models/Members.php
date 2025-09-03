<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use SoftDeletes; //Terhapus, tetapi di dalam database masih ada
    protected $fillable = [
        'nomor_anggota',
        'nik',
        'nama_anggota',
        'no_hp',
        'email'
    ];
}