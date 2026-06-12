@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

@if (empty($items))

    {{-- ====================== CART KOSONG ====================== --}}
    <div class="min-h-[60vh] flex items-center justify-center bg-[#faf8f3] py-20 px-4">
        <div class="flex flex-col items-center gap-4 text-center">

            <div class="w-20 h-20 flex items-center justify-center border-2 border-gray-300 rounded-xl bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>

            <h2 class="text-xl font-semibold text-gray-800">Keranjang Kosong</h2>
            <p class="text-sm text-gray-500">Belum ada produk yang ditambahkan</p>

            <a href="{{ route('menu.index') }}"
                class="mt-2 bg-[#7a1a1a] hover:bg-[#5e1212] text-white text-sm font-medium px-8 py-2.5 rounded-md transition">
                Mulai Belanja
            </a>

        </div>
    </div>

@else

    {{-- ====================== CART ADA ISI ====================== --}}
    <div class="bg-[#fff9ec] px-4 md:px-10 py-10">

        {{-- Judul --}}
        <h1 class="font-[Playfair_Display] text-4xl md:text-5xl font-bold text-[#451C07] mb-2">
            Keranjang Belanja
        </h1>
        <p class="text-sm text-gray-500 mb-8">
            <a href="{{ route('welcome') }}" class="hover:text-[#973035]">Home</a> / Shopping Cart
        </p>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-md bg-green-100 text-green-700 text-sm max-w-5xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

            {{-- List produk --}}
            <div class="lg:col-span-2 flex flex-col gap-4">
                @foreach ($items as $item)
                    <div class="bg-[#F2E8C5] rounded-xl p-5 flex items-center gap-5">

                        {{-- Gambar --}}
                        <img src="{{ asset('images/product/' . $item['product']->image) }}"
                             alt="{{ $item['product']->name }}"
                             class="w-24 h-24 rounded-lg object-cover shrink-0">

                        {{-- Info --}}
                        <div class="flex-1">
                            <h3 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-1">
                                {{ $item['product']->name }}
                            </h3>
                            <p class="text-[#973035] font-bold mb-3">
                                Rp {{ number_format($item['product']->price, 0, ',', '.') }}
                            </p>

                            {{-- Qty Stepper --}}
                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                @method('PATCH')

                                <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}"
                                        class="w-8 h-8 flex items-center justify-center bg-[#FBF8F3] rounded-md font-bold text-[#451C07] hover:bg-white transition">
                                    −
                                </button>

                                <span class="w-8 text-center font-semibold text-[#451C07]">{{ $item['qty'] }}</span>

                                <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}"
                                        class="w-8 h-8 flex items-center justify-center bg-[#FBF8F3] rounded-md font-bold text-[#451C07] hover:bg-white transition">
                                    +
                                </button>
                            </form>
                        </div>

                        {{-- Subtotal & hapus --}}
                        <div class="flex flex-col items-end justify-between h-full gap-6">
                            <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
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
                <h2 class="font-[Playfair_Display] text-2xl font-bold text-[#451C07] mb-4">
                    Ringkasan Pesanan
                </h2>

                <div class="border-t border-[#d7c2ba] pt-4 flex justify-between text-sm text-gray-700 mb-2">
                    <span>Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="border-t border-[#d7c2ba] pt-4 flex justify-between mb-6">
                    <span class="font-semibold text-[#451C07]">Total Tagihan</span>
                    <span class="font-bold text-[#973035]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout.create') }}"
                   class="block text-center bg-[#973035] hover:bg-[#702e2e] text-white font-semibold py-3 rounded-xl transition mb-3">
                    Checkout
                </a>

                <a href="{{ route('menu.index') }}"
                   class="block text-center border border-[#451C07] text-[#451C07] font-semibold py-3 rounded-xl hover:bg-[#451C07] hover:text-white transition">
                    Lanjut Belanja
                </a>
            </div>

        </div>
    </div>

@endif

@endsection