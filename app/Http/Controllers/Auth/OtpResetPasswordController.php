<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOTPNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OtpResetPasswordController extends Controller
{
    // 1. Fungsi untuk generate dan kirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate 6 digit angka acak
        $otp = rand(100000, 999999);

        // Simpan OTP dan masa berlaku (5 menit) ke database SQLite
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim notifikasi email (saat ini masih masuk ke storage/logs/laravel.log)
        $user->notify(new SendOTPNotification($otp));

        return response()->json([
            'message' => 'Kode OTP telah dikirim ke email Anda. Silakan cek kotak masuk/logs.',
            'email' => $request->email
        ]);
    }

    // 2. Fungsi untuk verifikasi OTP dan ganti password baru
    public function verifyOtpAndReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed', // butuh input 'password_confirmation' di frontend
        ]);

        // Cari user yang email, OTP cocok, dan OTP-nya belum expired
        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->where('otp_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Kode OTP salah atau sudah kedaluwarsa!'
            ], 422);
        }

        // OTP Valid -> Update password baru & bersihkan kolom OTP
        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'message' => 'Password berhasil diubah! Silakan login kembali.'
        ]);
    }
}