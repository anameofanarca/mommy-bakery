@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-14 items-center">
    <div>
        <span class="bg-[#F1E5D5] text-[#8B3A3A] px-4 py-2 rounded-full text-xs font-semibold">
            ❤️ HOMEMADE WITH HEART
        </span>

        <h1 class="text-5xl md:text-6xl font-bold leading-tight mt-6 font-[Playfair_Display] text-[#451C07]">
            Catering & Bakery <br>
            Lezat untuk setiap <br>
            momen spesial Anda
        </h1>

        <p class="mt-6 text-gray-600 leading-8 max-w-lg">
            Nikmati kehangatan cita rasa rumahan dalam setiap gigitan. Roti, kue, dan paket catering terbaik yang dibuat dengan bahan premium untuk melengkapi kebahagiaan Anda.
        </p>

        <div class="flex gap-4 mt-8">
            <a href="{{ route('menu.index') }}" class="bg-[#8B3A3A] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#702e2e] transition text-center">
                Pesan Sekarang
            </a>
        </div>
    </div>

    @php
    $bestSeller = $popularProducts->first();
    @endphp

    <div class="relative">
    <img 
        src="{{ $bestSeller && $bestSeller->image_url ? asset('storage/' . $bestSeller->image_url) : asset('images/product/default.png') }}" 
        alt="{{ $bestSeller?->name ?? 'Produk Unggulan' }}"
        class="rounded-[40px] shadow-xl w-full h-[550px] object-cover"
    >

    <div class="absolute -bottom-5 -left-5 bg-white p-5 rounded-3xl shadow-2xl border border-gray-100 flex items-center gap-4">
        
        <div class="w-14 h-14 bg-[#451C07] rounded-full flex items-center justify-center shrink-0">
            <svg class="w-7 h-7 text-[#D2B48C]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        </div>

        <div>
            <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Best Seller</span>
            <h3 class="font-[Playfair_Display] text-2xl text-[#451C07] font-bold mt-1 leading-tight">{{ $bestSeller?->name ?? 'Belum ada data' }}</h3>
        </div>

    </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="bg-[#F2E8C5] py-16">
    <div class="max-w-7xl mx-auto px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        
        <div class="p-4">
    <div class="w-24 h-24 bg-[#FBF8F3] rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm text-[#A43A3E]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
            <circle cx="12" cy="9" r="5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5l.6 1.2 1.4.2-1 .9.3 1.4-1.3-.7-1.3.7.3-1.4-1-.9 1.4-.2.6-1.2z" fill="currentColor" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 13.5L7 21l2.5-1.5L12 21l-.5-4.5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 13.5L17 21l-2.5-1.5L12 21" />
        </svg>
    </div>
    <h3 class="font-[Poppins] text-xl font-bold text-[#451C07] mb-2">Bahan Premium</h3>
    <p class="text-sm text-gray-600">Kualitas terbaik di setiap adonan</p>
</div>

        <div class="p-4">
            <div class="w-24 h-24 bg-[#FBF8F3] rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm text-[#A43A3E]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-10 h-10">
                    <path d="M12 2a1 1 0 0 1 1 1v.07A7.001 7.001 0 0 1 19 10v1H5v-1a7.001 7.001 0 0 1 6-6.93V3a1 1 0 0 1 1-1Zm-8 11h16a1 1 0 0 1 1 1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1a1 1 0 0 1 1-1Zm4 5h8a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <h3 class="font-[Poppins] text-xl font-bold text-[#451C07] mb-2">Dibuat Fresh</h3>
            <p class="text-sm text-gray-600">Dipanggang setiap hari dengan kasih</p>
        </div>

        <div class="p-4">
            <div class="w-24 h-24 bg-[#FBF8F3] rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm text-[#A43A3E]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-9 h-9">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM19.5 18.75a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 5.25h12.75v11.25H2.25V5.25Zm12.75 3h4.125c.621 0 1.125.504 1.125 1.125v5.625h-5.25V8.25Z" />
                </svg>
            </div>
            <h3 class="font-[Poppins] text-xl font-bold text-[#451C07] mb-2">Pengantaran Tepat</h3>
            <p class="text-sm text-gray-600">Sampai di tujuan tepat waktu</p>
        </div>

        <div class="p-4">
    <div class="w-24 h-24 bg-[#FBF8F3] rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm text-[#A43A3E]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
            <rect x="2" y="6" width="20" height="12" rx="2" stroke-linecap="round" stroke-linejoin="round" />
            
            <text x="50%" y="55%" 
                  dominant-baseline="middle" 
                  text-anchor="middle" 
                  font-family="Poppins, sans-serif" 
                  font-size="6.5" 
                  font-weight="800" 
                  fill="currentColor" 
                  stroke="none">
                Rp
            </text>
        </svg>
    </div>
    <h3 class="font-[Poppins] text-xl font-bold text-[#451C07] mb-2">Harga Terjangkau</h3>
    <p class="text-sm text-gray-600">Kualitas bintang lima, harga bersahabat</p>
</div>
        
    </div>
</section>

<!-- POPULAR PACKAGES SECTION -->
<section class="max-w-7xl mx-auto px-6 py-24">
    <h2 class="text-center font-[Playfair_Display] text-4xl md:text-5xl font-bold text-[#451C07] mb-16">
        Paket Populer
    </h2>

    <div class="grid md:grid-cols-3 gap-8 items-stretch">
    @foreach ($popularProducts as $product)
    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 flex flex-col h-full">
        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/product/default.png') }}"
            alt="{{ $product->name }}"
            class="w-full h-60 object-cover">

        <div class="p-6 flex flex-col flex-grow">
            <h3 class="font-[Playfair_Display] text-2xl font-bold text-[#451C07] mb-2">
                {{ $product->name }}
            </h3>
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ $product->description ?? 'Produk unggulan kami' }}
            </p>

            <div class="mt-auto">
                <span class="block text-[#973035] font-bold text-lg mb-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                <a href="{{ route('product.show', $product->id) }}"
                class="block w-full text-center bg-[#973035] text-white py-3 rounded-xl font-semibold hover:bg-[#702e2e] transition">
                    Lihat Menu
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
    </div>
</section>

<!-- CUSTOM MENU SECTION -->
<section class="max-w-7xl mx-auto px-6 pb-24">
    <div class="bg-[#F2E8C5] p-8 md:p-16 rounded-[40px] grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="font-[Playfair_Display] text-4xl md:text-5xl font-bold text-[#451C07] leading-tight mb-6">
                Kustomisasi Menu <br> Sesuai Selera
            </h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                Punya preferensi khusus untuk acara Anda? Kami melayani kustomisasi menu catering mulai dari diet khusus, tema rasa, hingga dekorasi kemasan yang estetik.
            </p>
            
            <ul class="space-y-4 mb-8 text-[#451C07] font-medium">
    <li class="flex items-center gap-3">
        <div class="w-6 h-6 bg-[#973035] rounded-full flex items-center justify-center shrink-0">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
            </svg>
        </div>
        <span class="text-lg">Pilihan Bahan Halal & Berkualitas</span>
    </li>

    <li class="flex items-center gap-3">
        <div class="w-6 h-6 bg-[#973035] rounded-full flex items-center justify-center shrink-0">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
            </svg>
        </div>
        <span class="text-lg">Packaging Eksklusif & Higienis</span>
    </li>

    <li class="flex items-center gap-3">
        <div class="w-6 h-6 bg-[#973035] rounded-full flex items-center justify-center shrink-0">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
            </svg>
        </div>
        <span class="text-lg">Layanan Server Profesional</span>
    </li>
</ul>

            <a href="{{ route('catering') }}" class="inline-block bg-[#973035] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#702e2e] transition">
                Buat Penawaran Custom
            </a>
        </div>

        <!-- Bagian Gambar Kolase -->
        <div class="grid grid-cols-2 gap-4">
            <img src="{{ asset('images/Detail-Cake.png') }}" alt="Cake" class="w-full h-60 object-cover rounded-2xl">

            <img src="{{ asset('images/Detail-Pastry.png') }}" alt="Pastry" class="w-full h-60 object-cover rounded-2xl">
        </div>
    </div> </section>

@endsection