<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    private function sendWhatsappOtp($phone, $otp)
    {
        // Ambil token dari env (ganti disini buat nomornya)
        $token = env('FONNTE_TOKEN', '7HCXUNskAnrkbA3REbRsbpR7F');

        Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => "Halo! \n\nKode OTP Mommy Bakery kamu adalah: *" . $otp . "*\n\nKode ini rahasia, berlaku selama 1 menit demi keamanan akun Anda.",
            'countryCode' => '62',
        ]);
    }

    public function index()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');
            return redirect()->route('login')->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        $this->sendWhatsappOtp($user->phone, $otp);

        return view('auth.verify-otplogin');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');
            return redirect()->route('login')->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        if (
            $user->otp != $request->otp ||
            !$user->otp_expires_at ||
            Carbon::now()->isAfter($user->otp_expires_at)
        ) {
            return back()->withErrors([
                'otp' => 'Kode OTP salah atau sudah kedaluwarsa.',
            ]);
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        Auth::login($user);
        session()->forget('otp_user_id');

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Login admin berhasil!');
        }

        return redirect()->route('welcome')->with('success', 'Login berhasil!');
    }

    public function resend()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');
            return response()->json(['message' => 'Akun tidak ditemukan.'], 404);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        // RESEND
        $this->sendWhatsappOtp($user->phone, $otp);

        return response()->json(['message' => 'OTP dikirim ulang via WhatsApp.']);
    }
}
