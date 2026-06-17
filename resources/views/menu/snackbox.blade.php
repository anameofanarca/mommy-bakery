@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-6" x-data="{ 
    isModalOpen: false, 
    selectedProductId: null,
    selectedPaket: '', 
    selectedHarga: 0, 
    maxIsian: 0,
    selectedSnacks: [],
    
    openCustomizer(id, nama, harga, limit) {
        this.selectedProductId = id;
        this.selectedPaket = nama;
        this.selectedHarga = harga;
        this.maxIsian = limit;
        this.selectedSnacks = [];
        this.isModalOpen = true;
    },
    
    toggleSnack(snackName) {
        if (this.selectedSnacks.includes(snackName)) {
            this.selectedSnacks = this.selectedSnacks.filter(item => item !== snackName);
        } else {
            if (this.selectedSnacks.length < this.maxIsian) {
                this.selectedSnacks.push(snackName);
            }
        }
    }
}">

    <p class="text-xs text-[#4A2C2A] mb-4">
        <a href="{{ url('/') }}" class="hover:underline cursor-pointer">Home</a>
        <span class="mx-1 text-gray-400">&gt;</span>
        <a href="{{ url('/menu') }}" class="hover:underline cursor-pointer">Menu</a>
        <span class="mx-1 text-gray-400">&gt;</span>
        <span class="text-[#A04545] font-semibold">Snack Box</span>
    </p>

    <h1 class="text-3xl font-serif font-bold text-[#4A2C2A] mb-6">
        Menu Kami
    </h1>

    <div class="mb-8">
        <div class="flex flex-wrap gap-2 text-xs font-medium">
            <a href="{{ url('/menu') }}"
               class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">
                Semua
            </a>

            <a href="{{ url('/menu/nasibox') }}"
               class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">
                Nasi Box
            </a>

            <a href="{{ url('/menu/tumpeng') }}"
               class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">
                Tumpeng
            </a>

            <a href="{{ url('/menu/prasmanan') }}"
               class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">
                Prasmanan
            </a>

            <a href="{{ url('/menu/bakery') }}"
               class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">
                Bakery
            </a>

            <a href="{{ url('/menu/snackbox') }}"
               class="bg-[#A04545] text-white px-4 py-2 rounded-md transition-colors inline-block text-center shadow-sm">
                Snack Box
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($products as $product)
            @php
                $name = $product->name;
                $price = (int) $product->price;

                $descriptionText = strtolower($product->description ?? '');

                if (str_contains($descriptionText, 'isi 7')) {
                    $limit = 7;
                } elseif (str_contains($descriptionText, 'isi 6')) {
                    $limit = 6;
                } elseif (str_contains($descriptionText, 'isi 5')) {
                    $limit = 5;
                } elseif (str_contains($descriptionText, 'isi 4')) {
                    $limit = 4;
                } elseif (str_contains($descriptionText, 'isi 3')) {
                    $limit = 3;
                } else {
                    $limit = 3;
                }
            @endphp

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
                <div class="h-48 overflow-hidden bg-[#FAF6F0] flex items-center justify-center">
                    <img
                        src="{{ $product->image_src }}"
                        class="w-full h-full object-cover"
                        alt="{{ $product->name }}"
                    >
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <span class="text-xs font-medium text-[#A04545]">
                        {{ $product->category }}
                    </span>

                    <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">
                        {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                    </p>
                    
                    <div class="flex justify-between items-end mt-4">
                        <div>
                            <span class="block text-base font-bold text-[#A04545]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>

                            <span class="text-[10px] text-gray-400">
                                Stok: {{ $product->stock ?? 0 }}
                            </span>
                        </div>

                        <button
                            type="button"
                            @click="openCustomizer({{ $product->id }}, '{{ addslashes($name) }}', {{ $price }}, {{ $limit }})"
                            class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0"
                        >
                            Lihat Detail <span class="text-sm">→</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-400">
                <p class="text-sm font-medium">Belum ada produk Snack Box</p>
            </div>
        @endforelse

    </div>

    {{-- MODAL PILIH ISIAN SNACK BOX --}}
    <div x-show="isModalOpen" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center p-4" x-transition style="display: none;">
        <div class="bg-[#FAF6F0] w-full max-w-md rounded-3xl overflow-hidden shadow-2xl border border-black/5 flex flex-col max-h-[85vh]" @click.away="isModalOpen = false">
            
            <div class="p-5 bg-white border-b border-black/5 flex items-center justify-between">
                <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="text-center flex-grow">
                    <h2 class="text-sm font-bold text-[#4A2C2A] uppercase tracking-wide" x-text="selectedPaket"></h2>
                    <p class="text-[10px] text-[#4A2C2A]/50 font-medium">Pilih Isian Box Sesuai Kuota</p>
                </div>

                <div class="w-6"></div>
            </div>

            <form method="POST" :action="'{{ url('/cart/add') }}/' + selectedProductId" class="flex flex-col flex-grow overflow-hidden">
                @csrf

                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="selected_items" :value="JSON.stringify(selectedSnacks)">

                <div class="overflow-y-auto p-5 flex-grow space-y-5">
                    
                    <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-black/5">
                        <div>
                            <h3 class="text-xs font-bold text-[#4A2C2A]">
                                Pilih Maksimal <span x-text="maxIsian"></span> Kue
                            </h3>
                            <p class="text-[10px] text-[#4A2C2A]/50 mt-0.5 font-medium">
                                Terpilih:
                                <span class="font-bold text-[#A04545]" x-text="selectedSnacks.length"></span>
                                dari
                                <span x-text="maxIsian"></span>
                            </p>
                        </div>

                        <span
                            class="text-[10px] font-bold px-3 py-1 rounded-full border"
                            :class="selectedSnacks.length === maxIsian 
                                ? 'bg-green-50 text-green-700 border-green-100' 
                                : 'bg-yellow-50 text-yellow-700 border-yellow-100'"
                            x-text="selectedSnacks.length === maxIsian ? 'Lengkap' : 'Belum lengkap'"
                        >
                        </span>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold text-[#A04545] uppercase tracking-wider mb-2.5 px-1">
                            Pilihan Asin / Gurih
                        </h4>

                        <div class="bg-white rounded-2xl divide-y divide-black/[0.03] border border-black/5 overflow-hidden">
                            <template x-for="snack in ['Lemper Ayam', 'Lontong Sayur', 'Risol Mayo', 'Pastel Ayam', 'Bakwan Udang', 'Martabak Telur Mini', 'Kroket Kentang']" :key="snack">
                                <label class="flex items-center justify-between p-4 cursor-pointer hover:bg-[#FAF6F0]/30 transition-colors">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center gap-3.5">
                                            <input
                                                type="checkbox"
                                                :disabled="!selectedSnacks.includes(snack) && selectedSnacks.length >= maxIsian"
                                                :checked="selectedSnacks.includes(snack)"
                                                @change="toggleSnack(snack)"
                                                class="w-4 h-4 rounded border-gray-300 text-[#A04545] focus:ring-[#A04545] accent-[#A04545]"
                                            >
                                            <span class="text-xs font-semibold text-[#4A2C2A]/80" x-text="snack"></span>
                                        </div>

                                        <span class="text-[10px] text-[#4A2C2A]/40 font-medium tracking-wide">
                                            Gurih
                                        </span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-bold text-[#A04545] uppercase tracking-wider mb-2.5 px-1">
                            Pilihan Manis & Tradisional
                        </h4>

                        <div class="bg-white rounded-2xl divide-y divide-black/[0.03] border border-black/5 overflow-hidden">
                            <template x-for="snack in ['Cente Manis', 'Kue Talam Pandan', 'Nona Manis', 'Donat Gula', 'Ketan Serundeng', 'Kue Lapis', 'Nagasari']" :key="snack">
                                <label class="flex items-center justify-between p-4 cursor-pointer hover:bg-[#FAF6F0]/30 transition-colors">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center gap-3.5">
                                            <input
                                                type="checkbox"
                                                :disabled="!selectedSnacks.includes(snack) && selectedSnacks.length >= maxIsian"
                                                :checked="selectedSnacks.includes(snack)"
                                                @change="toggleSnack(snack)"
                                                class="w-4 h-4 rounded border-gray-300 text-[#A04545] focus:ring-[#A04545] accent-[#A04545]"
                                            >
                                            <span class="text-xs font-semibold text-[#4A2C2A]/80" x-text="snack"></span>
                                        </div>

                                        <span class="text-[10px] text-orange-600/50 font-medium tracking-wide">
                                            Manis
                                        </span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                </div>

                <div class="p-5 bg-white border-t border-black/5">
                    <button
                        type="submit"
                        :disabled="selectedSnacks.length !== maxIsian"
                        class="w-full bg-[#A04545] hover:bg-[#853737] text-white py-3.5 rounded-2xl font-bold text-xs transition-colors disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer tracking-wide shadow-xs"
                    >
                        Tambah Pesanan - Rp <span x-text="selectedHarga.toLocaleString('id-ID')"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
