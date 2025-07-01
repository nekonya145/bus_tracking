<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/buses', BusApiController::class);
Route::put('/buses/update-status/{bus:plat}', [BusApiController::class, 'update_status']);