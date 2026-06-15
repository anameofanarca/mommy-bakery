@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 md:px-8 py-8">
    <p class="text-xs text-[#A04545] mb-6 font-medium flex items-center gap-1">
        <a href="{{ route('cart.index') }}" class="hover:underline flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="black" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Keranjang
        </a>
    </p>

    <h1 class="text-3xl font-serif font-bold text-[#4A2C2A] mb-2">Checkout</h1>
    <p class="text-xs text-gray-500 mb-8">Lengkapi data pengiriman Anda</p>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
        <div class="md:col-span-2 bg-[#ECE3BF] rounded-3xl p-6 border border-gray-100 shadow-sm">
            <form id="checkoutForm" action="{{ route('checkout.payment.save') }}" method="POST">
                @csrf

                {{-- Hidden supaya cocok dengan CheckoutController --}}
                <input type="hidden" name="delivery_type" value="delivery">
                <input type="hidden" name="schedule_at" id="schedule_at">

                <div class="mb-8">
                    <h2 class="text-sm font-bold text-[#4A2C2A] uppercase tracking-wider mb-4 border-b border-gray-200/50 pb-2">
                        Data Pemesan
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                                Nama Lengkap <span class="text-[#A04545]">*</span>
                            </label>
                            <input
                                type="text"
                                name="customer_name"
                                value="{{ old('customer_name') }}"
                                required
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                                No. WhatsApp <span class="text-[#A04545]">*</span>
                            </label>
                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                        >
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-sm font-bold text-[#4A2C2A] uppercase tracking-wider mb-4 border-b border-gray-200/50 pb-2">
                        Alamat Pengiriman
                    </h2>
                    
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                            Alamat Lengkap <span class="text-[#A04545]">*</span>
                        </label>
                        <textarea
                            name="address"
                            rows="3"
                            required
                            class="w-full bg-white border border-gray-200 rounded-xl p-4 text-sm focus:outline-none focus:border-[#A04545] resize-none"
                        >{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                                Kota <span class="text-[#A04545]">*</span>
                            </label>
                            <input
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                required
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">Kode Pos.</label>
                            <input
                                type="text"
                                name="postal_code"
                                value="{{ old('postal_code') }}"
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-sm font-bold text-[#4A2C2A] uppercase tracking-wider mb-4 border-b border-gray-200/50 pb-2">
                        Detail Acara
                    </h2>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                                Tanggal Acara <span class="text-[#A04545]">*</span>
                            </label>
                            <input
                                type="date"
                                id="event_date"
                                name="event_date"
                                value="{{ old('event_date') }}"
                                required
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">
                                Jam Acara <span class="text-[#A04545]">*</span>
                            </label>
                            <input
                                type="time"
                                id="event_time"
                                name="event_time"
                                value="{{ old('event_time') }}"
                                required
                                class="w-full h-11 bg-white border border-gray-200 rounded-xl px-4 text-sm focus:outline-none focus:border-[#A04545]"
                            >
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-[#4A2C2A] mb-1">Catatan Tambahan</label>
                        <textarea
                            name="note"
                            rows="2"
                            placeholder="Misal: alergi, permintaan khusus, dll"
                            class="w-full bg-white border border-gray-200 rounded-xl p-4 text-sm focus:outline-none focus:border-[#A04545] resize-none"
                        >{{ old('note') }}</textarea>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#A04545] hover:bg-[#883232] text-white h-12 rounded-xl transition-colors font-bold text-sm shadow-sm"
                >
                    Lanjut ke Pembayaran
                </button>
            </form>
        </div>

        <div class="bg-[#ECE3BF] rounded-xl p-6 border border-[#d8c99d] shadow-lg sticky top-6">
            <h2 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-5 border-b border-[#d7c2ba] pb-4">
                Ringkasan Pesanan
            </h2>

            <div class="space-y-5">
                <div class="flex justify-between text-sm text-[#451C07]">
                    <span>Subtotal</span>
                    <span class="font-bold">
                        Rp {{ number_format($subtotal ?? $total ?? 0, 0, ',', '.') }}
                    </span>
                </div>

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
</div>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', function () {
        const date = document.getElementById('event_date').value;
        const time = document.getElementById('event_time').value;

        if (date && time) {
            document.getElementById('schedule_at').value = `${date}T${time}`;
        }
    });
</script>
@endsection