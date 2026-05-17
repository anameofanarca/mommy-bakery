<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Mommy Catering & Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#A43A3E', textDark: '#52443E', darkBrown: '#451C07' },
                    fontFamily: {
                        libreBaskerville: ['"Libre Baskerville"', 'serif'],
                        libreCaslon: ['"Libre Caslon Text"', 'serif'],
                        beVietnam: ['"Be Vietnam Pro"', 'sans-serif']
                    },
                    keyframes: { fadeUp: { '0%': { opacity: 0, transform: 'translateY(30px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } } },
                    animation: { fadeUp: 'fadeUp 0.8s ease-out' }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Libre+Caslon+Text:wght@400;700&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#0f0f0f] overflow-x-hidden">
<div class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/Background-register.png');"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-black/70"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(164,58,62,0.25),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(255,220,150,0.15),transparent_40%)] animate-pulse"></div>

    <div class="relative bg-[#f6eee3]/95 backdrop-blur-md w-[440px] rounded-2xl shadow-2xl p-10 z-10 border border-white/20 animate-fadeUp hover:scale-[1.02] transition duration-300">

        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-lg">
                <img src="/images/logo-register.png" class="w-10 h-10 object-contain" alt="logo">
            </div>
        </div>

        <h1 class="text-center text-2xl font-libreCaslon text-darkBrown font-semibold">Mommy Catering</h1>
        <h2 class="text-center text-md font-beVietnam text-primary font-semibold mt-4">Verifikasi Kode OTP</h2>
        <p class="text-center text-xs text-gray-600 mt-1 mb-6 font-beVietnam leading-relaxed px-2">Masukkan 6 digit kode yang telah kami kirimkan ke nomor WhatsApp Anda.</p>

        <form method="POST" action="/otp-verify" class="space-y-6">
            @csrf
            <div class="flex justify-between gap-2 px-2" id="otp-inputs">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
                <input type="text" maxlength="1" class="w-12 h-12 text-center text-lg font-bold rounded-lg border border-gray-300 bg-[#fffaf4] text-darkBrown focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition shadow-sm">
            </div>
            <input type="hidden" name="otp_code" id="otp_code">

            <div class="text-center font-beVietnam text-xs text-gray-500">
                <div id="timer-container">
                    <span>⏱ Kirim ulang kode dalam </span><span id="countdown-timer" class="font-semibold text-primary">00:58</span>
                </div>
                <button type="button" id="btn-resend" class="hidden text-primary font-semibold hover:underline bg-transparent border-none outline-none cursor-pointer">Kirim ulang kode</button>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-[#7f2f32] text-white py-3 rounded-lg transition font-beVietnam font-medium flex items-center justify-center gap-2 shadow-md">
                <span>Verifikasi Sekarang</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </button>
        </form>

        <div class="text-center font-beVietnam text-xs text-gray-500 mt-6 pt-2 border-t border-gray-200/50">
            Bermasalah dengan nomor Anda? <a href="https://wa.me/your-number" target="_blank" class="text-primary font-semibold hover:underline">Hubungi Bantuan</a>
        </div>
    </div>
</div>

<script>
    // Logika Auto-Tab Input OTP & Penggabungan data
    const inputs = document.querySelectorAll('#otp-inputs input');
    const hiddenInput = document.getElementById('otp_code');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateHiddenInput();
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateHiddenInput() {
        let code = "";
        inputs.forEach(input => code += input.value);
        hiddenInput.value = code;
    }

    // Logika Timer Mundur (58 Detik)
    let time = 58;
    const timerDisplay = document.getElementById('countdown-timer');
    const timerContainer = document.getElementById('timer-container');
    const resendBtn = document.getElementById('btn-resend');

    const interval = setInterval(() => {
        time--;
        let seconds = time < 10 ? '0' + time : time;
        timerDisplay.textContent = `00:${seconds}`;

        if (time <= 0) {
            clearInterval(interval);
            timerContainer.classList.add('hidden');
            resendBtn.classList.remove('hidden');
        }
    }, 1000);
</script>
</body>
</html>