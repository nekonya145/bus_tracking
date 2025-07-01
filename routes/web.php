<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuteController;

Route::get('/login', [ProfileController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [ProfileController::class, 'masuk'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [GeneralController::class, 'index']);
    Route::post('/logout', [ProfileController::class, 'logout']);
    Route::get('/manajemen-bus', [BusController::class, 'manajemen_bus']);
    Route::get('/rute-bus', [BusController::class, 'manajemen_rute']);
    Route::post('/tambah-rute', [BusController::class, 'tambah_rute']);
    Route::get('/live-monitoring', [GeneralController::class, 'live_monitoring']);

    Route::post('/bus', [BusController::class, 'tambah_bus'])->name('bus.store');
    Route::put('/bus/{id}', [BusController::class, 'update'])->name('bus.update');
    Route::delete('/bus/{id}', [BusController::class, 'hapus'])->name('bus.destroy');

    Route::post('/rute', [RuteController::class, 'tambah_rute'])->name('rute.store');
    Route::put('/rute/{id}', [RuteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RuteController::class, 'hapus'])->name('rute.destroy');
});