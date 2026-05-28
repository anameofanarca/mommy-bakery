<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendOTPNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function index()
    {
        // Auto kirim OTP saat halaman dibuka
        $user = Auth::user();
        $otp = rand(100000, 999999);

        $user->update([
            'otp'            => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        $user->notify(new SendOTPNotification($otp));

        return view('auth.verify-otplogin');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();

        if (
            $user->otp != $request->otp ||
            Carbon::now()->isAfter($user->otp_expires_at)
        ) {
            return back()->withErrors([
                'otp' => 'Kode OTP salah atau sudah kedaluwarsa.'
            ]);
        }

        // OTP valid → bersihkan data OTP
        $user->update([
            'otp'            => null,
            'otp_expires_at' => null,
        ]);

        // Redirect ke halaman utama setelah login sukses
        return redirect('/')->with('success', 'Login berhasil!');
    }

    public function resend()
    {
        $user = Auth::user();
        $otp  = rand(100000, 999999);

        $user->update([
            'otp'            => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        $user->notify(new SendOTPNotification($otp));

        return response()->json([
            'message' => 'OTP dikirim ulang.'
        ]);
    }
}