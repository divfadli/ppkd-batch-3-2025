<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); }); 

// get, post, put, delete (melihat/read, insert/create, update, deleted)
Route::get('belajar', [BelajarController::class, 'index']);
Route::get('call_name', [BelajarController::class, 'getCallName']);

// Route dinamis untuk semua operasi
Route::get('{tipe}', [BelajarController::class, 'operasi'])
    ->whereIn('tipe', ['tambah', 'kurang', 'kali', 'bagi'])
    ->name('operasi');

Route::post('store/{tipe}', [BelajarController::class, 'storeOperasi'])
    ->whereIn('tipe', ['tambah', 'kurang', 'kali', 'bagi'])
    ->name('store_operasi');

    // Login
    Route::get('login',[LoginController::class, 'index']);
    Route::post('login_action',[LoginController::class, 'loginAction'])->name('login_action');

    // Dashboard
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('dashboard', DashboardController::class);

    // User
    Route::resource('user', UserController::class);

    // Categories
    Route::resource('categories',CategoriesController::class);

    // Rooms
    Route::resource('rooms',RoomsController::class);