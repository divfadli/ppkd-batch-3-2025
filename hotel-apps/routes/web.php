<?php

use App\Http\Controllers\BelajarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// get, post, put, delete (melihat/read, insert/create, update, deleted)

Route::get('/belajar',function(){
    return "<h1>Selamat Datang di Laravel</h1>";
});

Route::get('/name', [BelajarController::class, 'getCallName']);
Route::get('tambah-data', [BelajarController::class, 'tambah']);