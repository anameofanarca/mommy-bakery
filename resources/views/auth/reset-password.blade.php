<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - Mommy Catering & Bakery</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#A43A3E',
                        textDark: '#52443E',
                        darkBrown: '#451C07'
                    },
                    fontFamily: {
                        libreBaskerville: ['"Libre Baskerville"', 'serif'],
                        libreCaslon: ['"Libre Caslon Text"', 'serif'],
                        beVietnam: ['"Be Vietnam Pro"', 'sans-serif']
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: 0, transform: 'translateY(30px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' }
                        }
                    },
                    animation: {
                        fadeUp: 'fadeUp 0.8s ease-out'
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Libre+Caslon+Text:wght@400;700&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#0f0f0f] overflow-x-hidden">

<div class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('/images/Background-register.png');"></div>

    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-black/70"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[440px] rounded-2xl shadow-2xl p-10 z-10 border border-white/20
                animate-fadeUp hover:scale-[1.02] transition duration-300">

        @if (session('status') == 'password-updated' || session('status') == 'sukses' || session('success'))
            
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-[#ebdccb] rounded-full flex items-center justify-center shadow-inner">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>

            <h1 class="text-center text-2xl font-libreCaslon text-darkBrown font-semibold leading-snug">
                Kata Sandi Berhasil<br>Diperbarui
            </h1>

            <p class="text-center text-sm text-gray-600 mt-4 mb-6 font-beVietnam leading-relaxed px-2">
                Keamanan akun Anda telah diperbarui. Silakan login kembali menggunakan kata sandi baru Anda.
            </p>

            <div class="pt-2">
                <a href="{{ route('login') }}" class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium flex items-center justify-center gap-2 shadow-md">
                    <span>Kembali ke Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

        @else

            <div class="flex justify-center mb-4">
                <a href="{{ url('/') }}"
                   class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-lg hover:scale-105 transition">
                    <img src="/images/logo-register.png"
                         class="w-10 h-10 object-contain"
                         alt="logo">
                </a>
            </div>

            <h1 class="text-center text-2xl font-libreCaslon text-darkBrown font-semibold">
                Atur Ulang Kata Sandi
            </h1>
            
            <p class="text-center text-xs tracking-widest text-darkBrown/70 uppercase font-bold mt-1 mb-6 font-beVietnam">
                KITCHEN MANAGEMENT LOGIN
            </p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4 text-left">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') ?? 'dummy-token' }}">
                <input type="hidden" name="email" value="{{ old('email', $request->email ?? '') }}">

                <div>
                    <label for="password" class="text-sm font-beVietnam text-textDark block mb-1">
                        Kata Sandi Baru
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25z" />
                            </svg>
                        </span>
                        
                        <input type="password" id="password" name="password" required autofocus
                            placeholder="Min. 8 karakter"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                            font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>

                    @if ($errors->has('password'))
                        <span class="text-xs text-red-600 mt-1 block font-beVietnam">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-beVietnam text-textDark block mb-1">
                        Konfirmasi Kata Sandi
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25z" />
                            </svg>
                        </span>
                        
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="Ulangi kata sandi"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                            font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium flex items-center justify-center gap-2 shadow-md pt-2.5">
                    <span>Simpan Kata Sandi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

        @endif

        <div class="mt-8 pt-4 text-center border-t border-gray-200/50">
            <p class="text-xs text-gray-400 font-beVietnam">
                &copy; 2026 Mommy Catering & Bakery. All rights reserved.<br>Homemade with Heart.
            </p>
        </div>

    </div>
</div>

</body>
</html>