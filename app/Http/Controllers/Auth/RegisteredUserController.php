<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'unique:users',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&^]/',
            ],

            'phone' => ['required', 'string', 'max:20'],

        ], [
            'email.regex'          => 'Email harus menggunakan @gmail.com',
            'email.unique'         => 'Email sudah terdaftar.',
            'password.min'         => 'Password minimal 8 karakter.',
            'password.regex'       => 'Password harus mengandung huruf besar, angka, dan simbol.',
            'password.confirmed'   => 'Konfirmasi password tidak cocok.',
            'phone.required'       => 'Nomor telepon wajib diisi.',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'phone'       => $request->phone,
            'role'        => 'customer',
            'is_verified' => false,
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}