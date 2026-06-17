<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->phone) {
            return back()->withErrors(['email' => 'Akun ditemukan, tetapi nomor WhatsApp Anda belum terdaftar.']);
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

        return redirect()->route('password.otp.verify')
            ->with('status', 'Kode OTP telah dikirim ke nomor WhatsApp Anda!')
            ->with('email', $request->email);
    }
}
