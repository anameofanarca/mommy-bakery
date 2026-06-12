@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-6">

    <p class="text-xs text-[#4A2C2A] mb-4">
        <span class="hover:underline cursor-pointer">Home</span> 
        <span class="mx-1 text-gray-400">&gt;</span> 
        <span class="text-[#A04545] font-semibold">Menu</span>
    </p>

    <h1 class="text-3xl font-serif font-bold text-[#4A2C2A] mb-6">
        Menu Kami
    </h1>

    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-8">
        <div class="relative w-full md:w-72">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input
                type="text"
                placeholder="Cari produk..."
                class="w-full bg-[#EFE7D8] text-[#4A2C2A] placeholder-gray-400 rounded-lg pl-9 pr-4 py-2 text-xs border border-transparent focus:outline-none focus:ring-1 focus:ring-[#A04545]"
            >
        </div>

        <div class="flex flex-wrap gap-2 text-xs font-medium">
            <a href="{{ url('/menu') }}" class="bg-[#A04545] text-white px-4 py-2 rounded-md transition-colors inline-block text-center shadow-sm">Semua</a>
            <a href="{{ url('/menu/nasibox') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Nasi Box</a>
            <a href="{{ url('/menu/tumpeng') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Tumpeng</a>
            <a href="{{ url('/menu/prasmanan') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Prasmanan</a>
            <a href="{{ url('/menu/bakery') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Bakery</a>
            <a href="{{ url('/menu/snackbox') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Snack Box</a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($products as $product)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img 
                    src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/product/default.png') }}" 
                    class="w-full h-full object-cover" 
                    alt="{{ $product->name }}"
                >
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">{{ ucfirst($product->category) }}</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">{{ $product->name }}</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">{{ $product->description }}</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <a href="{{ route('product.show', $product->id) }}" 
                       class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1">
                        Lihat Detail <span class="text-sm">→</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-16 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-sm font-medium">Belum ada produk tersedia</p>
            <p class="text-xs mt-1">Produk akan segera hadir</p>
        </div>
        @endforelse

    </div>
</div>
@endsection