<?php

use Illuminate\Support\Facades\Route;
use App\Items\Http\Controllers\ItemController;

Route::middleware('auth:sanctum')
    ->prefix('items')
    ->group(function() {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/{item}', [ItemController::class, 'get'])->whereNumber('item');
        Route::post('/', [ItemController::class, 'create']);
        Route::post('/{item}', [ItemController::class, 'update'])->whereNumber('item');
        Route::delete('/{item}', [ItemController::class, 'delete'])->whereNumber('item');
    });
