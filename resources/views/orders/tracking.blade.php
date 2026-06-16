@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FBF7EF] py-14">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-[#3B1F14] mb-3">
                Tracking Pesanan
            </h1>

            <p class="text-[#6B7280]">
                Lihat status dan detail pesanan Anda di sini.
            </p>
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-[28px] border border-[#E8DED2] shadow-sm p-10 text-center">
                <h2 class="text-2xl font-bold text-[#3B1F14] mb-3">
                    Belum ada pesanan
                </h2>

                <p class="text-[#6B7280] mb-7">
                    Pesanan Anda akan tampil di sini setelah checkout berhasil.
                </p>

                <a href="{{ route('menu.index') }}"
                   class="inline-block px-7 py-3 rounded-full bg-[#8B3A3A] text-white font-semibold hover:bg-[#6F2E2E] transition">
                    Lihat Menu
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-[28px] border border-[#E8DED2] shadow-sm p-7">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">

                            <div>
                                <p class="text-[#6B7280] mb-1">
                                    Kode Pesanan
                                </p>

                                <h2 class="text-2xl font-bold text-[#2B130C]">
                                    {{ $order->order_code }}
                                </h2>

                                <p class="text-[#6B7280] mt-3">
                                    Tanggal: {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <div class="text-left md:text-center">
                                <p class="text-[#6B7280] mb-1">
                                    Total Pembayaran
                                </p>

                                <p class="text-2xl font-bold text-[#2B130C]">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </p>

                                <span class="inline-flex mt-4 px-5 py-2 rounded-full text-sm font-semibold
                                    @if($order->status === 'pending_payment')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($order->status === 'paid')
                                        bg-green-100 text-green-700
                                    @elseif($order->status === 'processing')
                                        bg-blue-100 text-blue-700
                                    @elseif($order->status === 'completed')
                                        bg-emerald-100 text-emerald-700
                                    @elseif($order->status === 'cancelled')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-gray-100 text-gray-700
                                    @endif
                                ">
                                    @if($order->status === 'pending_payment')
                                        Menunggu Pembayaran
                                    @elseif($order->status === 'paid')
                                        Pembayaran Berhasil
                                    @elseif($order->status === 'processing')
                                        Sedang Diproses
                                    @elseif($order->status === 'completed')
                                        Selesai
                                    @elseif($order->status === 'cancelled')
                                        Dibatalkan
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    @endif
                                </span>
                            </div>

                            <div class="flex md:justify-end">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="px-7 py-3 rounded-full bg-[#3B1F14] text-white font-semibold text-center hover:bg-[#8B3A3A] transition">
                                    Detail
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection