<?php

use Illuminate\Support\Facades\Route;
use App\Requests\Http\Controllers\RequestController;

Route::middleware('auth:sanctum')
    ->prefix('requests')
    ->group(function() {
        Route::get('/', [RequestController::class, 'index']);
        Route::get('/{request}', [RequestController::class, 'get'])->whereNumber('request');
        Route::post('/', [RequestController::class, 'create']);
        Route::post('/{request}', [RequestController::class, 'update'])->whereNumber('request');
        Route::delete('/{request}', [RequestController::class, 'delete'])->whereNumber('request');
    });
