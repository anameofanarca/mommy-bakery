<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Auth\OtpResetPasswordController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\Auth\OtpController;

// Auth Controller Imports dari rute lama
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

// ==========================================
// MENU ROUTES
// ==========================================
Route::get('/menu', function () {
    return view('menu.index');
})->name('menu.index');

Route::get('/menu/nasibox', function () {
    return view('menu.nasibox');
});

Route::get('/menu/tumpeng', function () {
    return view('menu.tumpeng');
})->name('menu.tumpeng');

Route::get('/menu/prasmanan', function () {
    return view('menu.prasmanan');
});

Route::get('/menu/bakery', function () {
    return view('menu.bakery');
});

Route::get('/menu/snackbox', function () {
    return view('menu.snackbox');
});

Route::post('/cart/add', function(\Illuminate\Http\Request $request) {
    dd($request->all()); //
})->name('cart.add');

Route::get('/menu/snackbox/{id}', function ($id) {
    $limitKue = $id; 
    $daftarKue = [
        ['id' => 1, 'nama' => 'Risol Mayo Premium', 'harga' => 3500, 'gambar' => 'risol-mayo.png'],
        ['id' => 2, 'nama' => 'Lemper Ayam Spesial', 'harga' => 3500, 'gambar' => 'lemper.png'],
        ['id' => 3, 'nama' => 'Pastel Ayam Sayur', 'harga' => 3000, 'gambar' => 'pastel.png'],
        ['id' => 4, 'nama' => 'Sosis Solo Daging Sapi', 'harga' => 3500, 'gambar' => 'sosis-solo.png'],
        ['id' => 5, 'nama' => 'Kroket Kentang Ayam', 'harga' => 3500, 'gambar' => 'kroket.png'],
        ['id' => 6, 'nama' => 'Arem-arem Isi Daging', 'harga' => 3000, 'gambar' => 'arem-arem.png'],
        ['id' => 7, 'nama' => 'Kue Sus Fla Vanila', 'harga' => 3000, 'gambar' => 'sus.png'],
        ['id' => 8, 'nama' => 'Brownies Potong Almond', 'harga' => 4000, 'gambar' => 'brownies.png'],
        ['id' => 9, 'nama' => 'Kue Lumpur Surga', 'harga' => 3500, 'gambar' => 'kue-lumpur.png'],
        ['id' => 10, 'nama' => 'Nagasari Daun Pisang', 'harga' => 2500, 'gambar' => 'nagasari.png'],
        ['id' => 11, 'nama' => 'Dadar Gulung Unti Kelapa', 'harga' => 2500, 'gambar' => 'dadar-gulung.png'],
        ['id' => 12, 'nama' => 'Bolu Kukus Mekar', 'harga' => 2500, 'gambar' => 'bolu-kukus.png'],
        ['id' => 13, 'nama' => 'Pie Buah Segar', 'harga' => 4500, 'gambar' => 'pie-buah.png'],
        ['id' => 14, 'nama' => 'Lapis Legit Potong', 'harga' => 4000, 'gambar' => 'lapis-legit.png'],
        ['id' => 15, 'nama' => 'Puding Sutra Cup', 'harga' => 4000, 'gambar' => 'puding.png'],
    ];
    return view('menu.snackbox-detail', compact('limitKue', 'daftarKue'));
})->name('snackbox.detail');

// ==========================================
// GENERAL & STATIC PAGES
// ==========================================
Route::view('/', 'welcome')->name('welcome');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/catering', function () {
    return view('catering');
})->name('catering');

Route::post('/catering/store', [CateringController::class, 'store'])
    ->name('catering.store');

// ==========================================
// AUTH & OTP GUEST
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    Route::get('otp', [OtpController::class, 'index'])->name('otp');
    Route::post('/otp/verify-login', [OtpController::class, 'verify'])->name('otp.verify-login');
    Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');
});

// ==========================================
// PRODUCTS, CART, & CHECKOUT
// ==========================================
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/orders/{order}/payment', [OrderPaymentController::class, 'show'])->name('orders.payment.show');
Route::post('/orders/{order}/payment-proof', [OrderPaymentController::class, 'uploadProof'])->name('orders.payment.proof');
Route::get('/orders/{order}/whatsapp', [WhatsAppController::class, 'redirect'])->name('orders.whatsapp');

// ==========================================
// ADMIN DASHBOARD & PROFILES
// ==========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::patch('/payments/{payment}/verify', [AdminPaymentController::class, 'verify'])->name('admin.payments.verify');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// //require __DIR__.'/auth.php';

// ==========================================
// OTP RESET PASSWORD
// ==========================================
Route::post('/otp/send', [OtpResetPasswordController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [OtpResetPasswordController::class, 'verifyOtpAndReset'])->name('otp.verify');

// chart
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// ==========================================
// ADMIN PAGES
// ==========================================
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/product', function () {
    return view('admin.product');
})->name('admin.product');

Route::get('/admin/product/create', function () {
    return view('admin.add-product');
})->name('admin.product.create');

Route::get('/admin/orders', function () {
    return view('admin.orders');
})->name('admin.orders');

Route::get('/admin/payments', function () {
    return view('admin.payments');
})->name('admin.payments');

// //BUAT CEK LOCALHOST AJAAAAAAAAAA
// // cek tampilan Lupa Kata Sandi 
// Route::get('/cek-forgot', function () {
//     return view('auth.forgot-password'); 
// });
// 
// // cek setelah email berhasil terkirim
// Route::get('/cek-forgot-sukses', function () {
//     session()->flash('status', 'We have emailed your password reset link!');
//     return view('auth.forgot-password');
// });
// 
// // cek tampilan Atur ulang kata sandi 
// Route::get('/cek-reset', function () {
//     return view('auth.reset-password', ['request' => request()]);
// });
// 
// // cek setelah kata sandi berhasil diubah
// Route::get('/cek-reset-sukses', function () {
//     // Memaksa session status bernilai 'password-updated' agar blade mendeteksi kondisi sukses
//     session()->flash('status', 'password-updated');
//    
//     // Membuat object request dummy agar variable $request tidak error/undefined di blade
//     $dummyRequest = request();
//    
//     return view('auth.reset-password', ['request' => $dummyRequest]);
// });
// 
// // cek halaman OTP 
// Route::get('/cek-otp', function () {
//     return view('auth.auth-otp'); // sesuaikan dengan nama file otp kamu
// });