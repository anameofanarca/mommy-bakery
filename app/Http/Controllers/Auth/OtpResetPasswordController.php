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
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->phone) {
            return back()->withErrors(['email' => 'Akun ditemukan, tetapi nomor WhatsApp Anda belum terdaftar di sistem kami.']);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        $token = 'ESmYfYLy4gNFL9Y8Nan7'; 
        
        Http::asForm()
            ->withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $user->phone,
                'message' => "Mommy Bakery Security!\n\nKami menerima permintaan reset password untuk akun Anda. Kode OTP konfirmasi Anda adalah: *" . $otp . "*\n\nJangan berikan kode ini kepada siapapun. Berlaku 5 menit.",
                'countryCode' => '62',
            ]);

        return redirect()->route('password.reset', ['token' => $otp])
            ->with('status', 'Kode OTP telah dikirim ke nomor WhatsApp Anda!')
            ->with('email', $request->email);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token, 
            'email' => $request->email ?? session('email')
        ]);
    }

    public function showVerifyForm()
    {
        return view('auth.auth-otp');
    }

    public function verifyOtpAndReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->token)
                    ->where('otp_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return back()->withErrors(['token' => 'Kode OTP salah atau sudah kedaluwarsa!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login memakai password baru.');
    }
}
