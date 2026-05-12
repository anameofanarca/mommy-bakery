<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('/orders/{order}/payment', [OrderPaymentController::class, 'show']);
Route::post('/orders/{order}/payment-proof', [OrderPaymentController::class, 'uploadProof']);

Route::get('/orders/{order}/whatsapp', [WhatsAppController::class, 'redirect']);