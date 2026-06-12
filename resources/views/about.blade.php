@extends('layouts.app')

@section('content')

<!-- HERO ABOUT -->
<section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-black/40 z-10"></div>
        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1600&q=80"
             alt="Artisanal Bread Hero"
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-20 text-center px-6 max-w-3xl">
        <h1 class="font-[Playfair_Display] text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg">
            Warisan Rasa dari Dapur Ibu
        </h1>
        <p class="text-white/90 leading-relaxed text-base md:text-lg">
            Berawal dari kecintaan pada masakan rumahan di tahun 2015, Mommy Catering &amp; Bakery lahir untuk
            membawa kehangatan meja makan keluarga ke setiap acara Anda. Kami percaya bahwa setiap suapan
            harus membawa cerita dan cinta.
        </p>
    </div>
</section>

<!-- FILOSOFI / VALUES -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <h2 class="font-[Playfair_Display] text-3xl md:text-5xl font-bold text-[#451C07] mb-3">
            Filosofi Kami
        </h2>
        <div class="h-1 w-24 bg-[#973035] mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Value 1 -->
        <div class="bg-[#FBF8F3] p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-[#F2E8C5] rounded-full flex items-center justify-center mb-5 text-[#A43A3E]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22c4.97 0 9-4.03 9-9-4.97 0-9 4.03-9 9Zm0 0c-4.97 0-9-4.03-9-9 4.97 0 9 4.03 9 9Zm0 0V9m0 0a5 5 0 0 1 5-5h2a5 5 0 0 1-5 5h-2Zm0 0a5 5 0 0 0-5-5H5a5 5 0 0 0 5 5h2Z" />
                </svg>
            </div>
            <h3 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-2">Bahan Alami</h3>
            <p class="text-sm text-gray-600">Hanya menggunakan bahan baku pilihan, segar, dan tanpa pengawet tambahan untuk kualitas terbaik.</p>
        </div>

        <!-- Value 2 -->
        <div class="bg-[#FBF8F3] p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-[#F2E8C5] rounded-full flex items-center justify-center mb-5 text-[#A43A3E]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h3 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-2">Resep Warisan</h3>
            <p class="text-sm text-gray-600">Menjaga keaslian rasa dengan teknik memasak dan memanggang tradisional yang turun-temurun.</p>
        </div>

        <!-- Value 3 -->
        <div class="bg-[#FBF8F3] p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-[#F2E8C5] rounded-full flex items-center justify-center mb-5 text-[#A43A3E]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </div>
            <h3 class="font-[Playfair_Display] text-xl font-bold text-[#451C07] mb-2">Dibuat dengan Hati</h3>
            <p class="text-sm text-gray-600">Setiap pesanan diproses dengan ketelitian dan kasih sayang layaknya memasak untuk keluarga sendiri.</p>
        </div>
    </div>
</section>

<!-- MEET THE OWNER -->
<section class="bg-[#F2E8C5] py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <div class="relative group">
            <div class="absolute -inset-4 bg-[#973035]/10 rounded-3xl transform -rotate-3 transition-transform group-hover:rotate-0"></div>
            {{-- TODO: ganti src ini dengan foto owner asli --}}
            <img src="{{ asset('images/mamaiik.png') }}"
                 alt="Pemilik Mommy Catering"
                 class="relative rounded-3xl shadow-xl w-full aspect-[4/3] object-cover">
        </div>

        <div>
            <h2 class="font-[Playfair_Display] text-3xl md:text-5xl font-bold text-[#451C07] mb-5 leading-tight">
                Kenali Sosok di Balik <br> Mommy Catering
            </h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                Perjalanan "Mommy" dimulai dari dapur kecil di rumah, di mana aroma roti yang baru matang
                selalu menjadi magnet bagi tetangga dan kerabat. Dengan pengalaman lebih dari dua dekade
                dalam dunia kuliner tradisional, beliau memutuskan untuk membagikan kebahagiaan tersebut
                secara lebih luas.
            </p>
            <p class="text-gray-700 leading-relaxed mb-6">
                Dedikasi beliau terhadap kualitas tidak pernah kompromi. Mulai dari memilih tepung terbaik
                hingga memastikan setiap kotak katering tertata dengan rapi, semuanya dilakukan dengan
                standar profesionalisme tanpa menghilangkan sentuhan personal "Ibu".
            </p>
            <div class="border-l-4 border-[#973035] pl-4">
                <span class="block font-[Playfair_Display] text-xl font-bold text-[#451C07]">Sri Mudiyati</span>
                <span class="text-gray-500 italic">Founder &amp; Head Baker</span>
            </div>
        </div>
    </div>
</section>

<!-- BEHIND THE SCENES GALLERY -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <h2 class="font-[Playfair_Display] text-3xl md:text-5xl font-bold text-[#451C07] mb-3">
            Di Balik Layar Kami
        </h2>
        <p class="text-gray-600">Melihat lebih dekat proses pembuatan karya-karya lezat kami</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4 h-[600px] md:h-[450px]">
        <div class="col-span-2 row-span-1 md:row-span-2 overflow-hidden rounded-2xl">
            <img src="https://images.unsplash.com/photo-1556909212-d5b65c47095e?auto=format&fit=crop&w=1000&q=80"
                 alt="Aktivitas Dapur"
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="col-span-1 row-span-1 overflow-hidden rounded-2xl">
            <img src="https://images.unsplash.com/photo-1490474418585-ba9bad8fd0ea?auto=format&fit=crop&w=600&q=80"
                 alt="Bahan-bahan Segar"
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="col-span-1 row-span-1 overflow-hidden rounded-2xl">
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=600&q=80"
                 alt="Proses Pembuatan Adonan"
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="col-span-2 md:col-span-1 row-span-1 overflow-hidden rounded-2xl">
            <img src="https://images.unsplash.com/photo-1612203985729-70726954388c?auto=format&fit=crop&w=600&q=80"
                 alt="Sentuhan Akhir"
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="hidden md:block col-span-1 row-span-1 overflow-hidden rounded-2xl">
            <img src="https://images.unsplash.com/photo-1556910636-31912dc9d1b1?auto=format&fit=crop&w=600&q=80"
                 alt="Tim Kami"
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-14 bg-[#451C07] text-white text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="font-[Playfair_Display] text-3xl md:text-5xl font-bold mb-4">
            Siap untuk Mencicipi Kehangatan Kami?
        </h2>
        <p class="mb-8 opacity-90 leading-relaxed">
            Beri kami kesempatan untuk membuat acara Anda menjadi tak terlupakan dengan hidangan istimewa kami.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('menu.index') }}" class="bg-[#973035] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#702e2e] transition">
                Lihat Menu
            </a>
            <a href="{{ route('contact') }}" class="border border-white text-white px-6 py-3 rounded-xl font-semibold hover:bg-white hover:text-[#451C07] transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@endsection