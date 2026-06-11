<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\OtpController;              // ← fix import
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CateringController;

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::view('/', 'welcome')->name('welcome');

Route::get('/catering', function () {
    return view('catering');
})->name('catering');
Route::post('/catering/store', [CateringController::class, 'store'])
    ->name('catering.store');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

     Route::get('/otp', [OtpController::class, 'index'])   // ← pindah ke sini
    ->name('otp');

    Route::post('/otp/verify-login', [OtpController::class, 'verify'])->name('otp.verify-login');
    Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
// //BUAT CEK LOCALHOST AJAAAAAAAAAA
// // cek tampilan Lupa Kata Sandi 
// Route::get('/cek-forgot', function () {
//     return view('auth.forgot-password'); 
// });

// // cek setelah email berhasil terkirim
// Route::get('/cek-forgot-sukses', function () {
//     session()->flash('status', 'We have emailed your password reset link!');
//     return view('auth.forgot-password');
// });

// // cek tampilan Atur ulang kata sandi 
// Route::get('/cek-reset', function () {
//     return view('auth.reset-password', ['request' => request()]);
// });

// // cek setelah kata sandi berhasil diubah
// Route::get('/cek-reset-sukses', function () {
//     // Memaksa session status bernilai 'password-updated' agar blade mendeteksi kondisi sukses
//     session()->flash('status', 'password-updated');
    
//     // Membuat object request dummy agar variable $request tidak error/undefined di blade
//     $dummyRequest = request();
    
//     return view('auth.reset-password', ['request' => $dummyRequest]);
// });

// // cek halaman OTP 
// Route::get('/cek-otp', function () {
//     return view('auth.auth-otp'); // sesuaikan dengan nama file otp kamu
// });
