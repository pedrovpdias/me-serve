<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

// Rotas da API

// CATEGORIAS
Route::get('/api/categories', [CategoriesController::class, 'index'])->name('categories');

// PRODUTOS
Route::get('/api/products', [ProductsController::class, 'index'])->name('products');

// PAGAMENTO
Route::get('/api/payment-status', [PaymentController::class, 'index'])->name('payment-status');

// PEDIDOS
Route::post('/api/orders', [OrderController::class, 'store'])->name('orders.store');

// Retorna os 10 pedidos mais recentes
Route::get('/api/latest-orders', [OrderController::class, 'latestOrders'])->name('orders.latest');
// Conta quantos pedidos foram feitos hoje
Route::get('/api/daily-orders-counter', [OrderController::class, 'dailyOrdersCounter'])->name('orders.daily-counter');
// Retorna o faturamento do dia
Route::get('/api/daily-billing', [OrderController::class, 'dailyBilling'])->name('orders.daily-billing');
// Retorna a quantidade de produtos vendidos do dia
Route::get('/api/daily-products-sold', [OrderController::class, 'dailyProductsSold'])->name('orders.daily-products-sold');

// Verificar e-mail de login
Route::post('/api/login/verify-email', [AuthController::class, 'verifyEmail'])->name('login.verify-email');

// Rotas do Vue
Route::get('/{any}', function () {
    return view('app'); // app.blade.php será carregado com o Vue
})->where('any', '.*');