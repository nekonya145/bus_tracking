<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;

Route::get('/login', [ProfileController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [ProfileController::class, 'masuk'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [GeneralController::class, 'index']);
    Route::post('/logout', [ProfileController::class, 'logout']);
    Route::get('/manajemen-bus', [BusController::class, 'manajemen_bus']);
    Route::get('/rute-bus', [BusController::class, 'manajemen_rute']);
    Route::post('/tambah-rute', [BusController::class, 'tambah_rute']);
    Route::get('/live-monitoring', [GeneralController::class, 'live_monitoring']);
});