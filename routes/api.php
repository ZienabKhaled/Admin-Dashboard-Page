<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::middleware(['is_active'])->group(function () {

    Route::get('/products', [ProductController::class, 'index']);


    Route::get('/products/create', [ProductController::class, 'create']);

    Route::post('/products', [ProductController::class, 'store']);

    // Route::get('/products/{product}/edit', [ProductController::class, 'edit']);

    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.edit');

    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Route::get('/products', [YajraController::class, 'indexYajra'])->name('products.yajra');
});

