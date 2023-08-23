<?php

use Illuminate\Support\Facades\Route;
use App\Users\Http\Controllers\UserController;

Route::prefix('users')
    ->group(function() {
        Route::post('/login', [UserController::class, 'login']);
    });

Route::middleware('auth:sanctum')
    ->prefix('users')
    ->group(function() {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/current', [UserController::class, 'user']);
    });
