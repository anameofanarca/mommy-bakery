@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-6" x-data="{ 
    isModalOpen: false, 
    selectedPaket: '', 
    selectedHarga: 0, 
    maxIsian: 0,
    selectedSnacks: [],
    
    openCustomizer(nama, harga, limit) {
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
        <span class="hover:underline cursor-pointer">Home</span> 
        <span class="mx-1 text-gray-400">&gt;</span> 
        <span class="hover:underline cursor-pointer">Menu</span> 
        <span class="mx-1 text-gray-400">&gt;</span> 
        <span class="text-[#A04545] font-semibold">Snack Box</span>
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
            <a href="{{ url('/menu') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Semua</a>
            <a href="{{ url('/menu/nasibox') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Nasi Box</a>
            <a href="{{ url('/menu/tumpeng') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Tumpeng</a>
            <a href="{{ url('/menu/prasmanan') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Prasmanan</a>
            <a href="{{ url('/menu/bakery') }}" class="bg-[#EFE7D8] text-[#4A2C2A] hover:bg-[#e4dac6] px-4 py-2 rounded-md transition-colors inline-block text-center">Bakery</a>
            <a href="{{ url('/menu/snackbox') }}" class="bg-[#A04545] text-white px-4 py-2 rounded-md transition-colors inline-block text-center shadow-sm">Snack Box</a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 7 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 7 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 3 jenis kue pilihan</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 7.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 7 ribu', 7000, 3)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 10 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 10 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 4 jenis kue pilihan</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 10.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 10 ribu', 10000, 4)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 12 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 12 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 5 jenis kue pilihan</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 12.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 12 ribu', 12000, 5)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 15 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 15 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 5 jenis kue pilihan + Air Mineral</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 15.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 15 ribu', 15000, 5)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 20 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 20 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 6 jenis kue pilihan + Air Mineral</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 20.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 20 ribu', 20000, 6)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box 22 ribu">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <span class="text-xs font-medium text-[#A04545]">Snack Box</span>
                <h3 class="text-lg font-bold text-[#4A2C2A] mt-1 line-clamp-1">Snack Box 22 ribu</h3>
                <p class="text-xs text-gray-500 mt-1 flex-grow line-clamp-2">snack box isi 7 jenis kue premium + Air Mineral</p>
                
                <div class="flex justify-between items-end mt-4">
                    <div>
                        <span class="block text-base font-bold text-[#A04545]">Rp 22.000</span>
                        <span class="text-[10px] text-gray-400">1 box</span>
                    </div>
                    <button @click="openCustomizer('Snack Box 22 ribu', 22000, 7)" class="text-xs font-medium text-[#A04545] hover:underline flex items-center gap-1 mb-1 cursor-pointer bg-transparent border-none p-0">
                        Lihat Detail <span class="text-sm">→</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div x-show="isModalOpen" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center p-4" x-transition style="display: none;">
        <div class="bg-[#FAF6F0] w-full max-w-md rounded-3xl overflow-hidden shadow-2xl border border-black/5 flex flex-col max-h-[85vh]" @click.away="isModalOpen = false">
            
            <div class="p-5 bg-white border-b border-black/5 flex items-center justify-between">
                <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <div class="text-center flex-grow">
                    <h2 class="text-sm font-bold text-[#4A2C2A] uppercase tracking-wide" x-text="selectedPaket"></h2>
                    <p class="text-[10px] text-[#4A2C2A]/50 font-medium">Pilih Isian Box Sesuai Kuota</p>
                </div>
                <div class="w-6"></div>
            </div>

            <div class="overflow-y-auto p-5 flex-grow space-y-5">
                
                <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-black/5">
                    <div>
                        <h3 class="text-xs font-bold text-[#4A2C2A]">Pilih Maksimal <span x-text="maxIsian"></span> Kue</h3>
                        <p class="text-[10px] text-[#4A2C2A]/50 mt-0.5 font-medium">Terpilih: <span class="font-bold text-[#A04545]" x-text="selectedSnacks.length"></span> dari <span x-text="maxIsian"></span></p>
                    </div>
                    <span class="bg-green-50 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full border border-green-100">
                        Aktif
                    </span>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-[#A04545] uppercase tracking-wider mb-2.5 px-1">Pilihan Asin / Gurih</h4>
                    <div class="bg-white rounded-2xl divide-y divide-black/[0.03] border border-black/5 overflow-hidden">
                        <template x-for="snack in ['Lemper Ayam', 'Lontong Sayur', 'Risol Mayo', 'Pastel Ayam', 'Bakwan Udang', 'Martabak Telur Mini', 'Kroket Kentang']">
                            <label class="flex items-center justify-between p-4 cursor-pointer hover:bg-[#FAF6F0]/30 transition-colors">
                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center gap-3.5">
                                        <input type="checkbox" :disabled="!selectedSnacks.includes(snack) && selectedSnacks.length >= maxIsian" :checked="selectedSnacks.includes(snack)" @change="toggleSnack(snack)" class="w-4 h-4 rounded border-gray-300 text-[#A04545] focus:ring-[#A04545] accent-[#A04545]">
                                        <span class="text-xs font-semibold text-[#4A2C2A]/80" x-text="snack"></span>
                                    </div>
                                    <span class="text-[10px] text-[#4A2C2A]/40 font-medium tracking-wide">Gurih</span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-[#A04545] uppercase tracking-wider mb-2.5 px-1">Pilihan Manis & Tradisional</h4>
                    <div class="bg-white rounded-2xl divide-y divide-black/[0.03] border border-black/5 overflow-hidden">
                        <template x-for="snack in ['Cente Manis', 'Kue Talam Pandan', 'Nona Manis', 'Donat Gula', 'Ketan Serundeng', 'Kue Lapis', 'Nagasari']">
                            <label class="flex items-center justify-between p-4 cursor-pointer hover:bg-[#FAF6F0]/30 transition-colors">
                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center gap-3.5">
                                        <input type="checkbox" :disabled="!selectedSnacks.includes(snack) && selectedSnacks.length >= maxIsian" :checked="selectedSnacks.includes(snack)" @change="toggleSnack(snack)" class="w-4 h-4 rounded border-gray-300 text-[#A04545] focus:ring-[#A04545] accent-[#A04545]">
                                        <span class="text-xs font-semibold text-[#4A2C2A]/80" x-text="snack"></span>
                                    </div>
                                    <span class="text-[10px] text-orange-600/50 font-medium tracking-wide">Manis</span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>

            </div>

            <div class="p-5 bg-white border-t border-black/5">
                <button :disabled="selectedSnacks.length === 0" class="w-full bg-[#A04545] hover:bg-[#853737] text-white py-3.5 rounded-2xl font-bold text-xs transition-colors disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer tracking-wide shadow-xs">
                    Tambah Pesanan - Rp <span x-text="selectedHarga.toLocaleString('id-ID')"></span>
                </button>
            </div>

        </div>
    </div>

</div>
@endsection