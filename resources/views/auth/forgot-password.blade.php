<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Mommy Catering & Bakery</title>

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

        @if (session('status'))
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-[#EBE3D5] rounded-full flex items-center justify-center shadow-lg relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#451C07" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                    </svg>
                    <span class="absolute bottom-0 right-0 w-5 h-5 bg-primary rounded-full flex items-center justify-center border-2 border-[#f6eee3]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-2.5 h-2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <h1 class="text-center text-2xl font-libreCaslon text-darkBrown font-semibold leading-snug">
                Instruksi Pemulihan<br>Terkirim
            </h1>

            <p class="text-center text-sm text-gray-600 mt-3 mb-6 font-beVietnam leading-relaxed">
                Kami telah mengirimkan instruksi pemulihan kata sandi ke email terdaftar Anda. Silakan periksa kotak masuk atau folder spam Anda.
            </p>

            <div class="space-y-4">
                <a href="{{ route('login') }}"
                    class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium flex items-center justify-center gap-2 shadow-md">
                    <span>Kembali ke Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

        @else
            <div class="flex justify-center mb-6">
                <a href="{{ url('/') }}"
                   class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-lg hover:scale-105 transition">
                    <img src="/images/logo-register.png"
                         class="w-10 h-10 object-contain"
                         alt="logo">
                </a>
            </div>

            <h1 class="text-center text-2xl font-libreCaslon text-darkBrown font-semibold">
                Lupa Kata Sandi?
            </h1>

            <p class="text-center text-sm text-gray-600 mt-2 mb-6 font-beVietnam leading-relaxed">
                Masukkan email terdaftar Anda untuk menerima instruksi pemulihan kata sandi.
            </p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="text-sm font-beVietnam text-textDark block mb-1">
                        Email Pengguna
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5A2.25 2.25 0 0 1 2.25 17.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Masukkan alamat email anda"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                            font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>

                    @if ($errors->has('email'))
                        <span class="text-xs text-red-600 mt-1 block font-beVietnam">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium flex items-center justify-center gap-2 shadow-md">
                    <span>Kirim Instruksi Pemulihan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>

            </form>

            <div class="mt-6 pt-2 text-center border-t border-gray-200/50">
                <a href="{{ route('login') }}" class="text-sm text-primary font-semibold hover:underline font-beVietnam inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                    Kembali ke Halaman Login
                </a>
            </div>
        @endif

        <p class="text-center text-xs mt-6 text-gray-400 font-beVietnam">
            &copy; 2026 Mommy Catering & Bakery. All rights reserved.<br>Homemade with Heart.
        </p>

    </div>
</div>

</body>
</html>