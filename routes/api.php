<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/alive', [AuthController::class, 'alive']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/permissions', [AuthController::class, 'permissions']);
    });

    Route::apiResource('users', UserController::class);
    Route::get('products/shopping-cart', [ProductController::class, 'shoppingCart']);
    Route::get('products/wish-list', [ProductController::class, 'wishList']);
    Route::apiResource('products', ProductController::class);
});

Route::prefix('/public')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
})->middleware([]);
