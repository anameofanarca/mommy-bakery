<?php

use Illuminate\Support\Facades\Route;

// HOME PAGE
Route::view('/', 'welcome');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

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


require __DIR__.'/auth.php';