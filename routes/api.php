<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/admin', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/api/login/verify-email', [AuthController::class, 'verifyEmail'])->name('login.verify-email');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']); // Adicione a rota de logout