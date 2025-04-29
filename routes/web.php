<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PaymentController;

// Rotas da API

// Category
Route::get('/api/categories', [CategoriesController::class, 'index'])->name('categories');

// Product
Route::get('/api/products', [ProductsController::class, 'index'])->name('products');

// Pagamento
Route::get('/api/payment-status', [PaymentController::class, 'index'])->name('payment-status');


// Rotas do Vue
Route::get('/{any}', function () {
    return view('app'); // app.blade.php será carregado com o Vue
})->where('any', '.*');