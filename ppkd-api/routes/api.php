<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json('API sudah bisa digunakan');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [LoginController::class, 'me'])->name('me');
    Route::apiResource('user', UserController::class);
});

Route::post('login', [LoginController::class, 'login'])->name('login');
