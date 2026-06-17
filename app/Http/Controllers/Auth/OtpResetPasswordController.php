<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class OtpResetPasswordController extends Controller
{
    // generate dan kirim OTP ke WhatsApp
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        $token = env('FONNTE_TOKEN', 'MASUKKAN_TOKEN_FONNTE_KAMU_DISINI');
        
        Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $user->phone,
            'message' => "Mommy Bakery Security!\n\nKami menerima permintaan reset password untuk akun Anda. Kode OTP konfirmasi Anda adalah: *" . $otp . "*\n\nJangan berikan kode ini kepada siapapun. Berlaku 5 menit.",
            'countryCode' => '62',
        ]);

        return response()->json([
            'message' => 'Kode OTP telah dikirim ke nomor WhatsApp Anda yang terdaftar.',
            'email' => $request->email
        ]);
    }

    // verifikasi OTP dan ganti password baru
    public function verifyOtpAndReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->where('otp_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Kode OTP salah atau sudah kedaluwarsa!'
            ], 422);
        }

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
