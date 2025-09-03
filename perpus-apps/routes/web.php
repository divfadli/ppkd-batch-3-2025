<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'actionLogin'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Anggota
    // Route::resource('anggota',AnggotaController::class);
    Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::delete('anggota/soft-delete/{id}', [AnggotaController::class, 'softDelete'])->name('anggota.soft-deleted');
    Route::get('anggota/restore', [AnggotaController::class, 'indexRestore'])->name('anggota.index-restore');
    Route::get('anggota/restore/{id}', [AnggotaController::class, 'restore'])->name('anggota.restore');

    // Lokasi Buku
    Route::resource('lokasi', LocationsController::class);

    // Kategori Buku
    Route::resource('kategori', CategoriesController::class);

    // Buku
    Route::resource('buku', BooksController::class);

    // Transaksi
    Route::resource('transaction', TransactionController::class);
    Route::get('get-books/{id}', [TransactionController::class, 'getBukuByidCategory']);
    // Route::prefix('pinjam');
    // Route:prefix('pengembalian');
});