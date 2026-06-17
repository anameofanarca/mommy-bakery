<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function showOtpForm(): View
    {
        return view('auth.verify-otp-password', [
            'email' => session('email')
        ]);
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'numeric'],
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->where('otp_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return back()->withInput()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa!']);
        }

        return redirect()->route('password.reset', ['token' => $request->otp])
            ->with('email', $request->email);
    }

    public function create(Request $request, $token): View
    {
        return view('auth.reset-password', [
            'token' => $token, 
            'email' => $request->email ?? session('email')
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required', 'numeric'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->token)
                    ->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi reset password tidak valid. Silakan urus kembali.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login.');
    }
}
