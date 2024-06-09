<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/alive', [AuthController::class, 'alive']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('products.shopping-cart', ProductController::class)->except(['update', 'show']);
    Route::apiResource('products.wish-list', ProductController::class)->except(['update', 'show']);
});

Route::prefix('/public')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
})->middleware([]);
