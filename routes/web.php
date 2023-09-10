<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\YajraController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsActiveMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [ProductController::class, 'index'])->name('home');

// Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['is_active'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');


    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    Route::post('/products', [ProductController::class, 'store']);

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.edit');

    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Route::get('/products', [YajraController::class, 'indexYajra'])->name('products.yajra');
});

