<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Bakery</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#A43A3E',
                        textDark: '#52443E'
                    },
                    fontFamily: {
                        libreBaskerville: ['"Libre Baskerville"', 'serif'],
                        libreCaslon: ['"Libre Caslon Text"', 'serif'],
                        beVietnam: ['"Be Vietnam Pro"', 'sans-serif']
                    },
                    keyframes: {
                        floatSlow: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        floatReverse: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(25px)' }
                        },
                        fadeUp: {
                            '0%': { opacity: 0, transform: 'translateY(30px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' }
                        }
                    },
                    animation: {
                        floatSlow: 'floatSlow 6s ease-in-out infinite',
                        floatReverse: 'floatReverse 7s ease-in-out infinite',
                        fadeUp: 'fadeUp 0.8s ease-out'
                    }
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Libre+Caslon+Text:wght@400;700&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#0f0f0f] overflow-x-hidden">

<div class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0 bg-cover bg-center scale-110"
         style="background-image: url('/images/Background-register.png');"></div>

    <!-- DARK GRADIENT -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-black/70"></div>

    <!-- ✨ CINEMATIC LIGHT GLOW (moving atmosphere) -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <!-- 🌫 NOISE / GRAIN EFFECT -->
    <div class="absolute inset-0 opacity-[0.08] mix-blend-overlay pointer-events-none"
         style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');">
    </div>

    <!-- 🍞 FLOATING BLUR ORBS -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl animate-floatSlow"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-yellow-200/20 rounded-full blur-3xl animate-floatReverse"></div>
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>

    <!-- CARD -->
    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[440px] rounded-2xl shadow-2xl p-10 z-10 border border-white/20 animate-fadeUp hover:scale-[1.02] transition duration-300">

        <!-- LOGO -->
        <div class="flex justify-center mb-4">
            <a href="{{ url('/') }}"
            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-lg overflow-hidden animate-pulse hover:scale-105 transition">
                <img src="/images/logo-register.png"
                    class="w-10 h-10 object-contain"
                    alt="logo">
            </a>
        </div>

        <!-- TAB -->
        <div class="flex mb-6 overflow-hidden rounded-lg font-libreBaskerville">

            <a href="{{ route('login') }}"
               class="w-1/2 bg-[#f6eee3] text-primary py-2 text-center">
                Masuk
            </a>

            <a href="{{ route('register') }}"
               class="w-1/2 bg-primary text-white py-2 text-center font-semibold shadow-md">
                Daftar
            </a>

        </div>

        <!-- TITLE -->
        <h1 class="text-center text-2xl font-libreCaslon text-primary font-semibold">
            Buat akun baru Mommy Catering & Bakery
        </h1>

        <p class="text-center text-sm text-gray-600 mt-1 mb-6 font-beVietnam">
            Daftar untuk mulai memesan bakery favoritmu 🍞
        </p>

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">

            @csrf

            <!-- NAMA -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Nama Pengguna</label>

                <div class="relative mt-1">
                    <div class="absolute left-3 top-3.5 text-textDark">
                        <!-- user icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A10 10 0 0112 15c2.21 0 4.2.714 5.879 1.92M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.428 15.341A8 8 0 104.572 15.34"/>
                        </svg>
                    </div>

                    <input type="text" name="name" required
                        placeholder="Masukkan nama pengguna"
                        class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Email</label>

                <div class="relative mt-1">
                    <div class="absolute left-3 top-3.5 text-textDark">
                        <!-- email icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 8l7.89 4.26a2 2 0 001.22 0L21 8m-18 8h18V8H3v8z"/>
                        </svg>
                    </div>

                    <input type="email" name="email" required
                        placeholder="Masukkan email"
                        class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">

                        @error('email')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                </div>
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Password</label>

                <div class="relative mt-1">
                    <div class="absolute left-3 top-3.5 text-textDark">
                        <!-- lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 11c-1.104 0-2 .896-2 2v2h4v-2c0-1.104-.896-2-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 11V8a6 6 0 1112 0v3"/>
                            <rect x="3" y="11" width="18" height="10" rx="2"/>
                        </svg>
                    </div>

                    <input type="password" name="password" required
                        placeholder="Masukkan password"
                        class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <p class="text-xs text-gray-500 mt-1">
                            Password minimal 8 karakter,
                            harus ada huruf besar,
                            angka, dan simbol.
                        </p>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                         @enderror
                </div>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Konfirmasi Password</label>

                <div class="relative mt-1">
                    <div class="absolute left-3 top-3.5 text-textDark">
                        <!-- check icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <input type="password" name="password_confirmation" required
                        placeholder="Konfirmasi password"
                        class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>

            <!-- PHONE -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Nomor Telepon</label>

                <div class="relative mt-1">
                    <div class="absolute left-3 top-3.5 text-textDark">
                        <!-- phone icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 5a2 2 0 012-2h2.28a1 1 0 01.948.684l1.518 4.554a1 1 0 01-.272 1.06l-1.2 1.2a16 16 0 006.364 6.364l1.2-1.2a1 1 0 011.06-.272l4.554 1.518A1 1 0 0119 18.72V21a2 2 0 01-2 2h-1C9 23 1 15 1 5V4a2 2 0 012-2z"/>
                        </svg>
                    </div>

                    <input type="text" name="phone" required
                        placeholder="Masukkan nomor telepon"
                        class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium">
                Daftar
            </button>

        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm mt-5 text-textDark font-beVietnam">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary font-semibold">
                Masuk
            </a>
        </p>

    </div>

</div>

</body>
</html>