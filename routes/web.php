<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;

// Rotas da API

// Category
Route::get('/api/categories', [CategoriesController::class, 'index'])->name('categories');

// Product
Route::get('/api/products', [ProductsController::class, 'index'])->name('products');


// Rotas do Vue
Route::get('/{any}', function () {
    return view('app'); // app.blade.php será carregado com o Vue
})->where('any', '.*');