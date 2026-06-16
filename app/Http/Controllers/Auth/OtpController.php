<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOTPNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function index()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akun tidak ditemukan.',
                ]);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        $user->notify(new SendOTPNotification($otp));

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

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akun tidak ditemukan.',
                ]);
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
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login admin berhasil!');
        }

        return redirect()
            ->route('welcome')
            ->with('success', 'Login berhasil!');
    }

    public function resend()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');

            return response()->json([
                'message' => 'Akun tidak ditemukan.',
            ], 404);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
        ]);

        $user->notify(new SendOTPNotification($otp));

        return response()->json([
            'message' => 'OTP dikirim ulang.',
        ]);
    }
}