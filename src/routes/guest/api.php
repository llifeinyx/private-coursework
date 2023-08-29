<?php

use Illuminate\Support\Facades\Route;
use App\Guests\Http\Controllers\GuestController;

Route::middleware('auth:sanctum')
    ->prefix('guests')
    ->group(function() {
        Route::get('/', [GuestController::class, 'index']);
        Route::get('/{guest}', [GuestController::class, 'get'])->whereNumber('guest');
        Route::post('/', [GuestController::class, 'create']);
        Route::post('/{guest}', [GuestController::class, 'update'])->whereNumber('guest');
        Route::delete('/{guest}', [GuestController::class, 'delete'])->whereNumber('guest');
    });
