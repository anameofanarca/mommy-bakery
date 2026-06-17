<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.header')

    <main style="min-height: 620px; background: #FAF7EF; padding: 70px 20px;">
        <section style="
            max-width: 680px;
            margin: 0 auto;
            background: #FEF4D0;
            border-radius: 18px;
            padding: 48px 50px;
            text-align: center;
            box-shadow: 0 18px 35px rgba(0,0,0,0.18);
        ">
            <div style="
                width: 92px;
                height: 92px;
                border-radius: 50%;
                background: #D8F7D9;
                margin: 0 auto 24px;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <span style="
                    width: 58px;
                    height: 58px;
                    border-radius: 50%;
                    border: 5px solid #4FA64B;
                    color: #4FA64B;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 38px;
                    font-weight: 700;
                    line-height: 1;
                ">
                    ✓
                </span>
            </div>

            <h1 style="
                font-size: 36px;
                font-weight: 800;
                color: #111827;
                margin-bottom: 14px;
            ">
                Pesanan Berhasil!
            </h1>

            <p style="
                color: #4B5563;
                font-size: 18px;
                line-height: 1.6;
                max-width: 480px;
                margin: 0 auto 34px;
            ">
                Terima kasih telah memesan. Kami akan segera memverifikasi pembayaran Anda.
            </p>

            <div style="
                border: 1px solid #E8C891;
                border-radius: 14px;
                padding: 24px;
                background: rgba(255,255,255,0.28);
                margin-bottom: 28px;
            ">
                <p style="
                    color: #374151;
                    font-size: 14px;
                    line-height: 1.6;
                    margin-bottom: 18px;
                ">
                    Untuk konfirmasi lebih cepat, silakan hubungi kami via WhatsApp dengan
                    menyertakan bukti transfer dan detail pesanan Anda.
                </p>

                @php
    $phoneNumber = '6282322496181';
    $displayPhone = '+62 823-2249-6181';

    $message = "Halo Mommy Catering & Bakery,\n\n"
        . "Saya ingin konfirmasi pesanan berikut:\n\n"
        . "Kode Pesanan: " . $order->order_code . "\n"
        . "Nama: " . $order->customer_name . "\n"
        . "Total: Rp " . number_format($order->total, 0, ',', '.') . "\n\n"
        . "Mohon dibantu untuk pengecekan pesanan saya.\n"
        . "Terima kasih.";

    $waLink = 'https://wa.me/' . $phoneNumber . '?text=' . rawurlencode($message);
@endphp

                <a href="{{ $waLink }}" target="_blank" style="
                    display: block;
                    width: 100%;
                    background: #4FA64B;
                    color: white;
                    padding: 15px 18px;
                    border-radius: 10px;
                    text-decoration: none;
                    font-weight: 700;
                    font-size: 16px;
                ">
                    ☎ Konfirmasi via WhatsApp
                </a>
            </div>

            <p style="
                color: #6B7280;
                font-size: 14px;
                margin-bottom: 16px;
            ">
                Tim kami akan menghubungi Anda dalam 1×24 jam
            </p>

            <a href="/" style="
                color: #8B3A3A;
                font-weight: 700;
                text-decoration: none;
            ">
                Kembali ke Beranda
            </a>
        </section>
    </main>

    @include('layouts.footer')
</body>
</html>
