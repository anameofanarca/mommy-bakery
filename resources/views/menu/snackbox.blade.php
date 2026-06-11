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

    <h1 class="text-3xl font-serif font-bold text-[#4A2C2A] mb-6">Menu Snack Box</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('images/product/snackbox.png') }}" class="w-full h-full object-cover" alt="Snack Box">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#4A2C2A]">Snack Box 10 ribu</h3>
                <p class="text-xs text-gray-500 mb-4">Isi 4 kue pilihan</p>
                <button @click="openCustomizer('Snack Box 10 ribu', 10000, 4)" 
                        class="w-full bg-[#A04545] text-white py-2 rounded-lg text-xs font-bold">
                    Pilih Isi
                </button>
            </div>
        </div>
    </div>

    <div x-show="isModalOpen" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" style="display: none;">
        <form action="{{ route('cart.add') }}" method="POST" class="bg-[#FAF6F0] w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">
            @csrf
            <input type="hidden" name="nama_paket" x-model="selectedPaket">
            <input type="hidden" name="snack_terpilih" :value="JSON.stringify(selectedSnacks)">
            
            <div class="p-5 border-b border-black/5 flex justify-between">
                <h2 class="text-sm font-bold uppercase" x-text="selectedPaket"></h2>
                <button type="button" @click="isModalOpen = false">✕</button>
            </div>

            <div class="p-5 max-h-[60vh] overflow-y-auto">
                <div class="space-y-2">
                    <template x-for="snack in ['Lemper Ayam', 'Risol Mayo', 'Kue Lapis', 'Nagasari']">
                        <label class="flex items-center p-3 bg-white rounded-xl border border-black/5">
                            <input type="checkbox" 
                                   :disabled="!selectedSnacks.includes(snack) && selectedSnacks.length >= maxIsian"
                                   @change="toggleSnack(snack)"
                                   class="mr-3">
                            <span x-text="snack"></span>
                        </label>
                    </template>
                </div>
            </div>

            <div class="p-5 bg-white border-t">
                <button type="submit" 
                        :disabled="selectedSnacks.length < maxIsian"
                        class="w-full bg-[#A04545] text-white py-3 rounded-2xl font-bold text-xs disabled:opacity-50">
                    Tambah ke Keranjang - Rp <span x-text="selectedHarga.toLocaleString('id-ID')"></span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection