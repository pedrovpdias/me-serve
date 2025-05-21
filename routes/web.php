<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderStatusController;

// Rotas da API

// CATEGORIAS
Route::get('/api/categories', [CategoriesController::class, 'index'])->name('categories');


// PRODUTOS
Route::get('/api/products', [ProductsController::class, 'index'])->name('products');


// PAGAMENTO
Route::get('/api/payment-status', [PaymentController::class, 'index'])->name('payment-status');


// PEDIDOS
// Retorna os pedidos por paginação
Route::get('/api/orders', [OrdersController::class, 'index'])->name('orders');
Route::post('/api/orders', [OrdersController::class, 'store'])->name('orders.store');
// Altera o status do pedido
Route::put('/api/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');

// Retorna os 10 pedidos mais recentes
Route::get('/api/latest-orders', [OrdersController::class, 'latestOrders'])->name('orders.latest');
// Conta quantos pedidos foram feitos hoje
Route::get('/api/daily-orders-counter', [OrdersController::class, 'dailyOrdersCounter'])->name('orders.daily-counter');
// Retorna o faturamento do dia
Route::get('/api/daily-billing', [OrdersController::class, 'dailyBilling'])->name('orders.daily-billing');
// Retorna a quantidade de produtos vendidos do dia
Route::get('/api/daily-products-sold', [OrdersController::class, 'dailyProductsSold'])->name('orders.daily-products-sold');
// Retorna o total de produtos vendidos na última semana
Route::get('/api/weekly-products-sold', [OrdersController::class, 'weeklyProductsSold'])->name('orders.weekly-products-sold');

// PEDIDO
Route::get('/api/orders/{id}', [OrderController::class, 'index'])->name('order.details');
Route::put('/api/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

// STATUS
Route::get('/api/status', [OrderStatusController::class, 'index'])->name('status');

// VERIFICA SE O E-MAIL EXISTE NO BANCO DE DADOS
Route::post('/api/login/verify-email', [AuthController::class, 'verifyEmail'])->name('login.verify-email');

// Rotas do Vue
Route::get('/{any}', function () {
    return view('app'); // app.blade.php será carregado com o Vue
})->where('any', '.*');