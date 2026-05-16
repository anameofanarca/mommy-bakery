<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Mommy Catering</title>

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
         style="background-image: url('/images/Background-register.png');">
    </div>

    <!-- DARK OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-black/70"></div>

    <!-- GLOW -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <!-- NOISE -->
    <div class="absolute inset-0 opacity-[0.08] mix-blend-overlay pointer-events-none"
         style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');">
    </div>

    <!-- FLOATING ORBS -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl animate-floatSlow"></div>

    <div class="absolute bottom-10 right-10 w-72 h-72 bg-yellow-200/20 rounded-full blur-3xl animate-floatReverse"></div>

    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>

    <!-- CARD OTP -->
    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[430px]
                rounded-2xl shadow-2xl p-10 z-10 border border-white/20
                animate-fadeUp hover:scale-[1.02] transition duration-300">

        <!-- LOGO -->
        <div class="flex justify-center mb-4">
            <a href="{{ url('/') }}"
               class="w-16 h-16 bg-primary rounded-full flex items-center
                      justify-center shadow-lg overflow-hidden
                      animate-pulse hover:scale-105 transition">

                <img src="/images/logo-register.png"
                     class="w-10 h-10 object-contain"
                     alt="logo">
            </a>
        </div>

        <!-- BRAND -->
        <h1 class="text-center text-[34px] font-libreCaslon
                   text-primary font-bold leading-tight">
            Mommy Catering
        </h1>

        <!-- TITLE -->
        <div class="mt-8 text-center">

            <h2 class="text-[30px] font-libreCaslon
                       text-primary font-semibold">
                Verifikasi Kode OTP
            </h2>

            <p class="text-gray-600 text-sm mt-2
                      font-beVietnam leading-relaxed">
                Masukkan 6 digit kode yang telah kami
                kirimkan ke nomor WhatsApp Anda.
            </p>

        </div>

        <!-- FORM -->
        <form method="POST" action="" class="mt-8">
            @csrf

            <!-- OTP INPUT -->
            <div class="flex justify-center gap-3">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

                <input type="text" maxlength="1"
                    class="otp-input w-14 h-14 rounded-xl
                    border border-[#d9cfc3] bg-[#f9f3ea]
                    text-center text-xl font-semibold text-primary
                    focus:outline-none focus:ring-2 focus:ring-primary
                    transition duration-200">

            </div>

            <!-- TIMER -->
            <div class="text-center mt-6">

                <p class="text-sm text-gray-600 font-beVietnam
                          flex items-center justify-center gap-1">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4 text-gray-500"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    Kirim ulang kode dalam
                    <span class="text-primary font-semibold">
                        00:58
                    </span>

                </p>

                <button type="button"
                    class="mt-2 text-sm text-gray-400
                           font-medium cursor-not-allowed">
                    Kirim ulang kode
                </button>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full mt-8 bg-primary
                       hover:bg-[#7f2f32]
                       text-white py-3 rounded-lg
                       transition duration-300
                       font-beVietnam font-medium
                       shadow-md hover:shadow-xl">

                <div class="flex items-center justify-center gap-2">

                    Verifikasi Sekarang

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>

                </div>

            </button>

        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm mt-6
                  text-textDark font-beVietnam">

            Bermasalah dengan nomor Anda?

            <a href="#"
               class="text-primary font-semibold hover:underline">
                Hubungi Bantuan
            </a>

        </p>

    </div>

</div>

<!-- AUTO NEXT OTP -->
<script>

    const inputs = document.querySelectorAll('.otp-input');

    inputs.forEach((input, index) => {

        input.addEventListener('input', (e) => {

            e.target.value = e.target.value.replace(/[^0-9]/g, '');

            if (e.target.value.length === 1 &&
                index < inputs.length - 1) {

                inputs[index + 1].focus();
            }

        });

        input.addEventListener('keydown', (e) => {

            if (e.key === 'Backspace' &&
                !input.value &&
                index > 0) {

                inputs[index - 1].focus();
            }

        });

    });

</script>

</body>
</html>