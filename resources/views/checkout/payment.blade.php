@extends('layouts.app')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto px-4 md:px-8 py-8">

    <p class="text-xs text-[#A04545] mb-6 font-medium flex items-center gap-1">
        <a href="{{ route('checkout.create') }}" class="hover:underline flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="black" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Checkout
        </a>
    </p>

    <h1 class="text-3xl font-serif font-bold text-[#4A2C2A] mb-8">
        Pilih Metode Pembayaran
    </h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

            <div class="md:col-span-2 space-y-4">

                <label class="flex items-center justify-between bg-white border border-[#A04545] rounded-xl p-5 cursor-pointer hover:shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-lg bg-[#ECE3BF] flex items-center justify-center text-[#451C07]">
                            QR
                        </div>

                        <div>
                            <h2 class="font-[Playfair_Display] text-xl font-bold text-[#451C07]">
                                QRIS
                            </h2>
                            <p class="text-sm text-gray-600">
                                Instant payment via any e-wallet or bank app
                            </p>
                        </div>
                    </div>

                    <input
                        type="radio"
                        name="payment_method"
                        value="qris"
                        checked
                        class="w-5 h-5 accent-[#A04545]"
                    >
                </label>

                <label class="flex items-center justify-between bg-white border border-transparent rounded-xl p-5 cursor-pointer hover:border-[#A04545] hover:shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-lg bg-[#ECE3BF] flex items-center justify-center text-[#451C07]">
                            🏦
                        </div>

                        <div>
                            <h2 class="font-[Playfair_Display] text-xl font-bold text-[#451C07]">
                                Transfer Bank
                            </h2>
                            <p class="text-sm text-gray-600">
                                Manual transfer checked within 10 minutes
                            </p>
                        </div>
                    </div>

                    <input
                        type="radio"
                        name="payment_method"
                        value="transfer_bank"
                        class="w-5 h-5 accent-[#A04545]"
                    >
                </label>

                <button
                    type="submit"
                    class="w-full bg-[#A04545] hover:bg-[#883232] text-white h-12 rounded-xl transition-colors font-bold text-sm shadow-sm"
                >
                    Buat Pesanan
                </button>
            </div>

            <div class="bg-[#ECE3BF] rounded-xl p-6 border border-[#d8c99d] shadow-lg sticky top-6">
                <h2 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-5 border-b border-[#d7c2ba] pb-4">
                    Ringkasan Pesanan
                </h2>

                <div class="space-y-5">
                    <div class="flex justify-between text-sm text-[#451C07]">
                        <span>Subtotal</span>
                        <span class="font-bold">
                            Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    @if (($deliveryFee ?? 0) > 0)
                        <div class="flex justify-between text-sm text-[#451C07]">
                            <span>Ongkir</span>
                            <span class="font-bold">
                                Rp {{ number_format($deliveryFee, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    <hr class="border-[#d7c2ba]">

                    <div class="flex justify-between text-base">
                        <span class="font-[Playfair_Display] text-[#451C07]">
                            Total Tagihan
                        </span>
                        <span class="font-bold text-[#A04545]">
                            Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection