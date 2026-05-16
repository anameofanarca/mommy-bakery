<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bakery</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Libre+Caslon+Text:wght@400;700&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#0f0f0f] overflow-x-hidden">

<div class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('/images/Background-register.png');"></div>

    <!-- DARK OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-black/70"></div>

    <!-- GLOW -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <!-- NOISE -->
    <div class="absolute inset-0 opacity-[0.08] mix-blend-overlay pointer-events-none"
         style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');">
    </div>

    <!-- FLOATING ORBS (SAMAIN DENGAN REGISTER) -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl animate-floatSlow"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-yellow-200/20 rounded-full blur-3xl animate-floatReverse"></div>
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>

    <!-- CARD -->
    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[440px] rounded-2xl shadow-2xl p-10 z-10 border border-white/20
                animate-fadeUp hover:scale-[1.02] transition duration-300">

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
               class="w-1/2 bg-primary text-white py-2 text-center font-semibold shadow-md">
                Masuk
            </a>

            <a href="{{ route('register') }}"
               class="w-1/2 bg-[#f6eee3] text-primary py-2 text-center">
                Daftar
            </a>

        </div>

        <!-- TITLE -->
        <h1 class="text-center text-2xl font-libreCaslon text-primary font-semibold">
            Selamat Datang
        </h1>

        <p class="text-center text-sm text-gray-600 mt-1 mb-6 font-beVietnam">
            Masuk ke akun Mommy Catering & Bakery Anda
        </p>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">
                    Email atau Nomor Telepon
                </label>

                <input type="text" name="login" required
                    placeholder="Masukkan email atau nomor telepon"
                    class="w-full mt-1 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                    font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-sm font-beVietnam text-textDark">Password</label>

                <input type="password" name="password" required
                    placeholder="Masukkan password"
                    class="w-full mt-1 px-4 py-3 rounded-lg border border-gray-300 bg-[#fffaf4]
                    font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <!-- FORGOT -->
            <div class="flex justify-end">
                <a href="#" class="text-sm text-primary font-semibold hover:underline font-beVietnam">
                    Lupa kata sandi?
                </a>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium">
                Masuk
            </button>

        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm mt-5 text-textDark font-beVietnam">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary font-semibold">
                Daftar sekarang
            </a>
        </p>

    </div>

</div>

</body>
</html>