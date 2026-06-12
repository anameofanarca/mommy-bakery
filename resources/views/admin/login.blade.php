<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Mommy Catering & Bakery</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#A43A3E',
                        textDark: '#52443E',
                        cream: '#F6EEE3'
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

<body class="bg-[#0f0f0f] overflow-x-hidden overflow-y-auto">

<div class="min-h-screen flex items-center justify-center relative overflow-hidden py-12 px-4">

    {{-- Background --}}
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('/images/Background-register.png');"></div>

    <div class="absolute inset-0 bg-gradient-to-br from-black/75 via-black/45 to-black/75"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <div class="absolute inset-0 opacity-[0.08] mix-blend-overlay pointer-events-none"
         style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');">
    </div>

    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl animate-floatSlow pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-yellow-200/20 rounded-full blur-3xl animate-floatReverse pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse pointer-events-none"></div>

    {{-- Login Card --}}
    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[430px] rounded-2xl shadow-2xl p-10 z-10 border border-white/20
                animate-fadeUp hover:scale-[1.02] transition duration-300">

        {{-- Close Button --}}
        <a href="{{ url('/') }}"
           class="absolute top-4 right-4 text-gray-500 hover:text-primary transition duration-200 hover:scale-110 p-1 rounded-full hover:bg-black/5"
           title="Kembali ke Beranda">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        {{-- Logo --}}
        <div class="flex justify-center mb-4">
            <a href="{{ url('/') }}"
               class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-lg overflow-hidden animate-pulse hover:scale-105 transition">
                <img src="/images/logo-register.png"
                     class="w-10 h-10 object-contain"
                     alt="Logo Mommy Catering & Bakery">
            </a>
        </div>

        {{-- Title --}}
        <h1 class="text-center text-3xl font-libreCaslon text-[#3B2218] font-bold leading-tight">
            Mommy Catering<br>& Bakery
        </h1>

        <p class="text-center text-[11px] tracking-[2px] text-gray-500 mt-2 mb-8 font-beVietnam font-semibold">
            KITCHEN MANAGEMENT LOGIN
        </p>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700 text-sm font-beVietnam">
                {{ session('success') }}
            </div>
        @endif

        {{-- Admin Form --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="space-y-4">
            <div>
                <label class="text-sm font-beVietnam text-textDark font-semibold">
                    Username
                </label>

                <div class="relative">
                    <input type="text" name="username" required
                        placeholder="Enter admin username"
                        class="w-full mt-1 px-4 py-3 pl-10 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">

                    <span class="absolute left-3 top-[17px] text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                </div>
            </div>

            <div>
                <label class="text-sm font-beVietnam text-textDark font-semibold">
                    Password
                </label>

                <div class="relative">
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full mt-1 px-4 py-3 pl-10 rounded-lg border border-gray-300 bg-[#fffaf4]
                        font-beVietnam text-sm focus:outline-none focus:ring-2 focus:ring-primary">

                    <span class="absolute left-3 top-[17px] text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                </div>
            </div>

            <div class="flex justify-between items-center text-sm font-beVietnam">
                <label class="flex items-center gap-2 text-textDark">
                    <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary">
                    Remember me
                </label>

                <a href="#" class="text-primary font-semibold hover:underline">
                    Forgot password?
                </a>
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-semibold shadow-md">
                Sign In to Kitchen →
            </button>
        </form>

        <div class="border-t border-[#dfd3c3] mt-8 pt-5">
            <p class="text-center text-xs text-textDark font-beVietnam leading-relaxed">
                © 2024 Mommy Catering & Bakery.<br>
                Homemade with Heart.
            </p>
        </div>

    </div>
</div>

</body>
</html>