@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 md:px-8 py-8">
    <p class="text-xs text-[#4A2C2A] mb-6 font-medium">
        <a href="{{ url('/') }}" class="hover:underline">Home</a> 
        <span class="mx-1 text-gray-400">&gt;</span> 
        <a href="{{ route('menu.index') }}" class="hover:underline">Menu</a>
        <span class="mx-1 text-gray-400">&gt;</span> 
        <span class="text-[#A04545] font-semibold">{{ $product->name }}</span>
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
        <div class="aspect-square w-full rounded-2xl overflow-hidden bg-[#FAF6F0] flex items-center justify-center border border-gray-100 p-6">
            <img 
                src="{{ $product->image_src }}"
                alt="{{ $product->name }}" 
                class="w-full h-full object-contain"
            >
        </div>

        <div class="flex flex-col h-full justify-between">
            <div>
                <div class="flex justify-between items-start">
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-[#4A2C2A] leading-tight">
                        {{ $product->name }}
                    </h1>
                    <span class="bg-[#E8F5E9] text-[#2E7D32] text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider whitespace-nowrap">
                        In Stock
                    </span>
                </div>

                <div class="text-2xl md:text-3xl font-bold text-[#A04545] mt-3">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <div class="flex flex-wrap items-center gap-2 mt-3">
                    <span class="bg-[#EFE7D8] text-[#4A2C2A] text-[10px] font-medium px-2.5 py-1 rounded uppercase tracking-wider">
                        {{ $product->category }}
                    </span>
                    <span class="text-xs text-gray-500">
                        Sisa stok: {{ $product->stock ?? 0 }} pcs
                    </span>
                </div>

                <hr class="my-6 border-gray-100">

                <p class="text-sm text-gray-600 leading-relaxed">
                    <span class="block font-bold text-[#4A2C2A] mb-1">Deskripsi Produk:</span>
                    {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                </p>

                <div class="mt-6">
                    <span class="block text-xs font-bold text-[#4A2C2A] tracking-wider mb-3">VARIAN</span>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="bg-[#A04545] text-white text-xs font-medium px-6 py-2 rounded-full border border-[#A04545] transition-all shadow-sm">
                            Default
                        </button>
                    </div>
                </div>
            </div>

            {{-- Form, stepper, dan tombol submit disatukan di sini --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-8 flex flex-wrap items-center gap-4" x-data="{ quantity: 1 }">
                @csrf
                
                <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm h-12">
                    <button type="button" @click="if(quantity > 1) quantity--" class="px-5 hover:bg-gray-50 text-gray-600 text-sm font-bold transition-colors border-r border-gray-100 h-full flex items-center justify-center">-</button>
                    
                    <input type="text" x-model="quantity" name="qty" :max="{{ $product->stock }}" class="w-12 text-center text-sm font-semibold focus:outline-none h-full bg-transparent" readonly>
                    
                    <button type="button" @click="if(quantity < {{ $product->stock }}) quantity++" class="px-5 hover:bg-gray-50 text-gray-600 text-sm font-bold transition-colors border-l border-gray-100 h-full flex items-center justify-center">+</button>
                </div>

                @if ($product->stock <= 0)
                    <button type="button" disabled class="flex-1 min-w-[200px] bg-gray-400 text-white h-12 rounded-xl text-xs font-bold cursor-not-allowed flex items-center justify-center gap-2">
                        Stok Habis
                    </button>
                @else
                    <button type="submit" class="flex-1 min-w-[200px] bg-[#4A2C2A] hover:bg-[#331D1C] text-white h-12 rounded-xl transition-colors text-xs font-bold shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection