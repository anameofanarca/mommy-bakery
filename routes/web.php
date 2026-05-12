<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentController;

Route::get('/', fn () => redirect('/products'));

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Checkout create order
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Payment page + upload proof
Route::get('/orders/{order}/payment', [OrderPaymentController::class, 'show'])->name('orders.payment.show');
Route::post('/orders/{order}/payment-proof', [OrderPaymentController::class, 'uploadProof'])->name('orders.payment.proof');

// WhatsApp confirmation (redirect)
Route::get('/orders/{order}/whatsapp', [WhatsAppController::class, 'redirect'])->name('orders.whatsapp');

// Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');

    Route::patch('/payments/{payment}/verify', [AdminPaymentController::class, 'verify'])->name('admin.payments.verify');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
