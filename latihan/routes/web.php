<?php

use App\Http\Controllers\BangunRuangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Bangun Ruang
Route::get('/bangun-ruang', [BangunRuangController::class, 'index'])->name('bangun-ruang');

// Kubus
Route::get('/bangun-ruang/kubus', [BangunRuangController::class, 'indexKubus'])->name('kubus');
Route::post('/bangun-ruang/kubus', [BangunRuangController::class, 'operasiKubus'])->name('kubus.operasi');

// Balok
Route::get('/bangun-ruang/balok', [BangunRuangController::class, 'indexBalok'])->name('balok');
Route::post('/bangun-ruang/balok', [BangunRuangController::class, 'operasiBalok'])->name('balok.operasi');

// Limas Segi Empat
Route::get('/bangun-ruang/limas-segi-empat', [BangunRuangController::class, 'indexLimasSegiEmpat'])->name('limas-segi-empat');
Route::post('/bangun-ruang/limas-segi-empat', [BangunRuangController::class, 'operasiLimasSegiEmpat'])->name('limas-segi-empat.operasi');

// Tabung
Route::get('/bangun-ruang/tabung', [BangunRuangController::class, 'indexTabung'])->name('tabung');
Route::post('/bangun-ruang/tabung', [BangunRuangController::class, 'operasiTabung'])->name('tabung.operasi');

// Bola
Route::get('/bangun-ruang/bola', [BangunRuangController::class, 'indexBola'])->name('bola');
Route::post('/bangun-ruang/bola', [BangunRuangController::class, 'operasiBola'])->name('bola.operasi');