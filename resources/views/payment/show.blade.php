<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css'])
    <style>
    body {
        margin: 0;
        background: #FAF7EF;
    }

    footer,
    .footer,
    .site-footer {
        margin-top: 0 !important;
    }
</style>
</head>
<body>
    @include('layouts.header')

    <main style="background: #FAF7EF; padding: 50px 20px 40px; margin: 0;">
        <section style="max-width: 760px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 28px;">
                <p style="
                    color: #8B3A3A;
                    font-weight: 700;
                    letter-spacing: 1px;
                    text-transform: uppercase;
                    font-size: 13px;
                    margin-bottom: 8px;
                ">
                    Checkout Payment
                </p>

                <h1 style="
                    font-size: 38px;
                    font-weight: 800;
                    color: #3B2A2A;
                    margin: 0;
                ">
                    Pembayaran Pesanan
                </h1>

                <p style="
                    margin-top: 10px;
                    color: #6B7280;
                    font-size: 16px;
                ">
                    Periksa kembali pesanan kamu sebelum melanjutkan pembayaran.
                </p>
            </div>

            <div style="
                background: #FFFDF8;
                border: 1px solid #E8DDC8;
                border-radius: 24px;
                box-shadow: 0 18px 38px rgba(59, 42, 42, 0.12);
                overflow: hidden;
            ">
                <div style="
                    background: linear-gradient(135deg, #FEF4D0 0%, #FFF8E7 100%);
                    padding: 34px 38px;
                    text-align: center;
                    border-bottom: 1px solid #E8DDC8;
                ">
                    <p style="
                        margin: 0 0 8px;
                        color: #7C6F64;
                        font-size: 15px;
                    ">
                        Kode Pesanan
                    </p>

                    <h2 style="
                        margin: 0 0 24px;
                        color: #3B2A2A;
                        font-size: 26px;
                        font-weight: 800;
                        letter-spacing: 1px;
                    ">
                        {{ $order->order_code }}
                    </h2>

                    <p style="
                        margin: 0 0 8px;
                        color: #7C6F64;
                        font-size: 15px;
                    ">
                        Total Pembayaran
                    </p>

                    <h2 style="
                        margin: 0;
                        color: #8B3A3A;
                        font-size: 38px;
                        font-weight: 900;
                    ">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </h2>
                </div>

                <div style="padding: 34px 38px;">
                    <h3 style="
                        margin: 0 0 22px;
                        color: #3B2A2A;
                        font-size: 24px;
                        font-weight: 800;
                    ">
                        Ringkasan Pesanan
                    </h3>

                    <div style="
                        display: grid;
                        gap: 14px;
                        margin-bottom: 26px;
                    ">
                        @foreach ($order->items as $item)
                            <div style="
                                display: flex;
                                justify-content: space-between;
                                gap: 18px;
                                align-items: flex-start;
                                padding: 18px;
                                background: #FAF7EF;
                                border: 1px solid #EEE4D2;
                                border-radius: 16px;
                            ">
                                <div>
                                    <strong style="
                                        display: block;
                                        color: #111827;
                                        font-size: 17px;
                                        margin-bottom: 6px;
                                    ">
                                        {{ $item->product_name_snapshot }}
                                    </strong>

                                    <span style="
                                        display: inline-block;
                                        color: #8B3A3A;
                                        background: #FEF4D0;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        font-size: 13px;
                                        font-weight: 700;
                                    ">
                                        Qty: {{ $item->qty }}
                                    </span>

                                    @if ($item->note)
                                        <p style="
                                            color: #6B7280;
                                            font-size: 13px;
                                            margin-top: 8px;
                                            margin-bottom: 0;
                                        ">
                                            {{ $item->note }}
                                        </p>
                                    @endif
                                </div>

                                <strong style="
                                    color: #3B2A2A;
                                    font-size: 17px;
                                    white-space: nowrap;
                                ">
                                    Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                </strong>
                            </div>
                        @endforeach
                    </div>

                    <div style="
                        background: #FEF4D0;
                        border-radius: 18px;
                        padding: 24px;
                        border: 1px solid #E8D99B;
                    ">
                        <div style="
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 14px;
                            color: #4B5563;
                            font-size: 16px;
                        ">
                            <span>Subtotal</span>
                            <strong style="color:#111827;">
                                Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div style="
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 18px;
                            color: #4B5563;
                            font-size: 16px;
                        ">
                            <span>Delivery Fee</span>
                            <strong style="color:#111827;">
                                Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div style="
                            border-top: 1px solid #D8C98C;
                            padding-top: 18px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            color: #8B3A3A;
                        ">
                            <span style="font-size: 22px; font-weight: 900;">Total</span>
                            <strong style="font-size: 26px;">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>

                    <p id="payment-status" style="
                        margin: 22px 0 0;
                        text-align: center;
                        color: #6B7280;
                        font-size: 15px;
                    ">
                        Status: Menunggu Pembayaran
                    </p>

                    <div style="text-align: center; margin-top: 26px;">
                        <button id="pay-button" style="
                            background: #8B3A3A;
                            color: white;
                            border: none;
                            border-radius: 14px;
                            padding: 15px 46px;
                            font-weight: 800;
                            font-size: 17px;
                            cursor: pointer;
                            box-shadow: 0 10px 20px rgba(139, 58, 58, 0.25);
                        ">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('layouts.footer')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('payment.success', $order->id) }}";
                },
                onPending: function(result) {
                    document.getElementById('payment-status').innerText = 'Status: Menunggu pembayaran';
                },
                onError: function(result) {
                    document.getElementById('payment-status').innerText = 'Status: Pembayaran gagal';
                },
                onClose: function() {
                    document.getElementById('payment-status').innerText = 'Status: Pembayaran ditutup';
                }
            });
        };

        setInterval(function () {
            fetch("{{ route('payment.checkStatus', $order->id) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'paid') {
                        document.getElementById('payment-status').innerText = 'Status: Pembayaran Berhasil';
                        window.location.href = "{{ route('payment.success', $order->id) }}";
                    }
                });
        }, 5000);
    </script>
</body>
</html>