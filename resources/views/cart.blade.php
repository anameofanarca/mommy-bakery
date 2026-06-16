@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

@if (empty($items))

{{-- ====================== CART KOSONG ====================== --}}
<section class="cart-empty-page">
    <div class="cart-empty-box">
        <div class="cart-empty-icon">
            <svg width="90" height="90" viewBox="0 0 24 24" fill="none">
                <path d="M6 7L8 3H16L18 7" stroke="#d1d5db" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M5 7H19V18C19 19.1 18.1 20 17 20H7C5.9 20 5 19.1 5 18V7Z" stroke="#d1d5db" stroke-width="1.6" stroke-linejoin="round" />
                <path d="M9 11C9 12.657 10.343 14 12 14C13.657 14 15 12.657 15 11" stroke="#d1d5db" stroke-width="1.6" stroke-linecap="round" />
            </svg>
        </div>

        <h1>Keranjang Kosong</h1>
        <p>Belum ada produk yang ditambahkan</p>

        <a href="{{ route('menu.index') }}" class="cart-empty-btn">
            Mulai Belanja
        </a>
    </div>
</section>

@else

{{-- ====================== CART ADA ISI ====================== --}}
<div class="bg-[#fff9ec] px-4 md:px-10 py-10 overflow-x-hidden">

    {{-- Judul --}}
    <div class="max-w-6xl mx-auto mb-8">
        <h1 class="font-[Playfair_Display] text-3xl md:text-4xl font-bold text-[#451C07] mb-2 leading-tight">
            Keranjang Belanja
        </h1>

        <p class="text-sm text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-[#973035]">Home</a> / Shopping Cart
        </p>
    </div>

    @if (session('success'))
        <div class="max-w-6xl mx-auto mb-6 px-4 py-3 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-6xl mx-auto mb-6 px-4 py-3 rounded-md bg-red-100 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

        {{-- List produk --}}
        <div class="lg:col-span-2 flex flex-col gap-4 min-w-0">
            @foreach ($items as $item)
                <div class="bg-[#F2E8C5] rounded-xl p-5 flex flex-col md:flex-row md:items-center gap-5 w-full min-w-0">

                    {{-- Gambar --}}
                    @if (!empty($item['product']->image_url))
                        <img src="{{ $item['product']->image_src }}"
                            alt="{{ $item['product']->name }}"
                            class="w-24 h-24 rounded-lg object-cover shrink-0">
                    @endif

                    {{-- Info --}}
                    <div class="flex-1 min-w-0 w-full">
                        <h3 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-1 break-words leading-snug">
                            {{ $item['product']->name }}
                        </h3>

                        <p class="text-[#973035] font-bold mb-3">
                            Rp {{ number_format($item['product']->price, 0, ',', '.') }}
                        </p>

                        {{-- Pilihan Snack Box --}}
                        @if (!empty($item['selected_items']))
                            <div class="mb-4 text-xs text-[#451C07] bg-[#FBF8F3]/70 rounded-lg p-3 max-w-full">
                                <p class="font-bold mb-1">Pilihan isi Snack Box:</p>

                                <ul class="list-disc list-inside space-y-1 text-gray-700">
                                    @foreach ($item['selected_items'] as $selected)
                                        <li class="break-words">{{ $selected }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Qty Stepper --}}
                        <form action="{{ route('cart.update', $item['cart_key']) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            @method('PATCH')

                            <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}"
                                class="w-8 h-8 flex items-center justify-center bg-[#FBF8F3] rounded-md font-bold text-[#451C07] hover:bg-white transition">
                                −
                            </button>

                            <span class="w-8 text-center font-semibold text-[#451C07]">
                                {{ $item['qty'] }}
                            </span>

                            <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}"
                                class="w-8 h-8 flex items-center justify-center bg-[#FBF8F3] rounded-md font-bold text-[#451C07] hover:bg-white transition">
                                +
                            </button>
                        </form>
                    </div>

                    {{-- Subtotal & hapus --}}
                    <div class="w-full md:w-auto flex md:flex-col items-center md:items-end justify-between h-full gap-4 shrink-0">
                        <form action="{{ route('cart.remove', $item['cart_key']) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-[#973035] hover:text-[#702e2e] transition" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>

                        <span class="font-bold text-[#451C07] whitespace-nowrap">
                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="bg-[#F2E8C5] rounded-xl p-6 h-fit">
            <h2 class="font-[Playfair_Display] text-2xl font-bold text-[#451C07] mb-4 border-b border-[#d7c2ba] pb-4">
                Ringkasan Pesanan
            </h2>

            <div class="flex justify-between text-sm text-gray-700 mb-4">
                <span>Subtotal</span>
                <span class="font-semibold">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>

            <div class="border-t border-[#d7c2ba] pt-4 flex justify-between mb-6">
                <span class="font-semibold text-[#451C07]">Total Tagihan</span>
                <span class="font-bold text-[#973035]">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>

            <a href="{{ route('checkout.create') }}"
                class="block w-full text-center bg-[#973035] hover:bg-[#702e2e] text-white text-sm font-semibold tracking-wide py-3 rounded-xl transition mb-3">
                Checkout
            </a>

            <a href="{{ route('menu.index') }}"
                class="block w-full text-center border border-[#451C07] text-[#451C07] text-sm font-semibold tracking-wide py-3 rounded-xl hover:bg-[#451C07] hover:text-white transition">
                Lanjut Belanja
            </a>
        </div>

    </div>
</div>

@endif

@endsection
