<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProductsController;

// Rotas da API

// Product
Route::get('/api/products', [ProductsController::class, 'index'])->name('products');


// Rotas do Vue
Route::get('/{any}', function () {
    return view('app'); // app.blade.php será carregado com o Vue
})->where('any', '.*');