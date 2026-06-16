@extends('layouts.app')

@section('content')
@php
    $calculatedSubtotal = $order->items->sum(function ($item) {
        return $item->qty * $item->price_snapshot;
    });

    $displaySubtotal = ($order->subtotal && $order->subtotal > 0)
        ? $order->subtotal
        : $calculatedSubtotal;

    $displayTotal = ($order->total && $order->total > 0)
        ? $order->total
        : $displaySubtotal + ($order->delivery_fee ?? 0);

    $statusLabel = match ($order->status) {
        'pending_payment' => 'Menunggu Pembayaran',
        'paid' => 'Pembayaran Berhasil',
        'processing' => 'Sedang Diproses',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
        default => ucfirst(str_replace('_', ' ', $order->status)),
    };
@endphp

<div class="min-h-screen bg-[#FBF7EF] py-14">
    <div class="max-w-5xl mx-auto px-6">

        <a href="{{ route('orders.tracking') }}"
           class="inline-block mb-6 text-[#8B3A3A] font-semibold hover:underline">
            ← Kembali ke Tracking Pesanan
        </a>

        <div class="bg-white rounded-[32px] border border-[#E8DED2] shadow-sm p-8">

            <h1 class="text-4xl font-bold text-[#3B1F14] mb-8">
                Detail Pesanan
            </h1>

            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-[#6B7280] mb-1">Kode Pesanan</p>
                    <p class="text-2xl font-bold text-[#2B130C]">
                        {{ $order->order_code }}
                    </p>
                </div>

                <div>
                    <p class="text-[#6B7280] mb-1">Status Pesanan</p>
                    <p class="text-2xl font-bold text-[#8B3A3A]">
                        {{ $statusLabel }}
                    </p>
                </div>

                <div>
                    <p class="text-[#6B7280] mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-[#2B130C]">
                        Rp {{ number_format($displayTotal, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-[#6B7280] mb-1">Tanggal Pesanan</p>
                    <p class="text-2xl font-bold text-[#2B130C]">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>

            <hr class="border-[#E8DED2] my-8">

            <div class="mb-10">
                <h2 class="text-2xl font-bold text-[#3B1F14] mb-5">
                    Informasi Pemesan
                </h2>

                <div class="grid md:grid-cols-2 gap-5">
                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Nama Pemesan</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ $order->customer_name }}
                        </p>
                    </div>

                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Nomor Telepon</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ $order->phone }}
                        </p>
                    </div>

                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Email</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ $order->email ?? '-' }}
                        </p>
                    </div>

                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Metode Pengiriman</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ $order->delivery_type === 'delivery' ? 'Delivery' : 'Pickup' }}
                        </p>
                    </div>

                    @if($order->delivery_type === 'delivery')
                        <div class="bg-[#FBF7EF] rounded-2xl p-5 md:col-span-2">
                            <p class="text-sm text-[#6B7280] mb-1">Alamat Pengiriman</p>
                            <p class="text-lg font-bold text-[#2B130C] leading-relaxed">
                                {{ $order->address ?? '-' }}
                            </p>
                        </div>
                    @endif

                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Jadwal Pesanan</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ $order->schedule_at ? \Carbon\Carbon::parse($order->schedule_at)->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <div class="bg-[#FBF7EF] rounded-2xl p-5">
                        <p class="text-sm text-[#6B7280] mb-1">Metode Pembayaran</p>
                        <p class="text-lg font-bold text-[#2B130C]">
                            {{ strtoupper($order->payment_method ?? 'QRIS') }}
                        </p>
                    </div>

                    @if($order->note)
                        <div class="bg-[#FBF7EF] rounded-2xl p-5 md:col-span-2">
                            <p class="text-sm text-[#6B7280] mb-1">Catatan</p>
                            <p class="text-lg font-bold text-[#2B130C] leading-relaxed">
                                {{ $order->note }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold text-[#3B1F14] mb-5">
                    Daftar Makanan yang Dipesan
                </h2>

                @if($order->items->isEmpty())
                    <div class="bg-[#FBF7EF] rounded-2xl p-5 text-[#6B7280]">
                        Belum ada item pesanan.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="bg-[#FBF7EF] rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-bold text-[#3B1F14]">
                                        {{ $item->product_name_snapshot }}
                                    </h3>

                                    <p class="text-[#6B7280] mt-1">
                                        {{ $item->qty }} x Rp {{ number_format($item->price_snapshot, 0, ',', '.') }}
                                    </p>

                                    @if($item->note)
                                        <p class="text-sm text-[#8B7A6C] mt-2">
                                            {{ $item->note }}
                                        </p>
                                    @endif
                                </div>

                                <div class="text-left md:text-right">
                                    <p class="text-sm text-[#6B7280]">Subtotal Item</p>
                                    <p class="text-xl font-bold text-[#3B1F14]">
                                        Rp {{ number_format($item->qty * $item->price_snapshot, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-[#FBF7EF] rounded-2xl p-6 mb-10">
                <h2 class="text-2xl font-bold text-[#3B1F14] mb-5">
                    Ringkasan Pembayaran
                </h2>

                <div class="space-y-3">
                    <div class="flex justify-between text-[#6B5A4F]">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($displaySubtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-[#6B5A4F]">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($order->delivery_fee ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t border-[#E8DED2] pt-4 flex justify-between text-2xl font-bold text-[#3B1F14]">
                        <span>Total</span>
                        <span>Rp {{ number_format($displayTotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-[#3B1F14] mb-5">
                    Tracking Status
                </h2>

                <div class="space-y-5">
                    <div class="flex gap-4">
                        <div class="w-5 h-5 rounded-full bg-green-500 mt-1"></div>
                        <div>
                            <p class="font-bold text-[#3B1F14]">Pesanan Dibuat</p>
                            <p class="text-sm text-[#6B5A4F]">Pesanan Anda sudah masuk ke sistem.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-5 h-5 rounded-full mt-1
                            {{ in_array($order->status, ['paid', 'processing', 'completed']) ? 'bg-green-500' : 'bg-gray-300' }}">
                        </div>
                        <div>
                            <p class="font-bold text-[#3B1F14]">Pembayaran Dikonfirmasi</p>
                            <p class="text-sm text-[#6B5A4F]">Pembayaran berhasil diterima.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-5 h-5 rounded-full mt-1
                            {{ in_array($order->status, ['processing', 'completed']) ? 'bg-green-500' : 'bg-gray-300' }}">
                        </div>
                        <div>
                            <p class="font-bold text-[#3B1F14]">Pesanan Diproses</p>
                            <p class="text-sm text-[#6B5A4F]">Pesanan sedang disiapkan oleh Mommy Bakery.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-5 h-5 rounded-full mt-1
                            {{ $order->status === 'completed' ? 'bg-green-500' : 'bg-gray-300' }}">
                        </div>
                        <div>
                            <p class="font-bold text-[#3B1F14]">Pesanan Selesai</p>
                            <p class="text-sm text-[#6B5A4F]">Pesanan telah selesai.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection