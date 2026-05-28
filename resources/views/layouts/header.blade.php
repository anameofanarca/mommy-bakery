<header class="border-b border-[#E5DED3] bg-[#F8F4EC]">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition">
            <img src="{{ asset('images/Icon.png') }}" alt="Mommy Bakery Logo" class="w-10 h-10 object-contain">
            
            <h1 class="text-2xl font-bold font-[Playfair_Display] text-[#4A2C2A]">
                Mommy Catering & Bakery
            </h1>
        </a>

        <nav class="hidden md:flex gap-8 text-sm font-medium text-[#52443E]">
            <a href="{{ url('/') }}" class="text-[#8B3A3A] font-semibold">Home</a>
            <a href="#" class="hover:text-[#8B3A3A] transition">Menu</a>
            <a href="#" class="hover:text-[#8B3A3A] transition">Catering</a>
            <a href="#" class="hover:text-[#8B3A3A] transition">About</a>
            <a href="#" class="hover:text-[#8B3A3A] transition">Contact</a>
        </nav>

        <div class="flex items-center gap-5 text-[#4A2C2A]">
            <button class="hover:text-[#8B3A3A] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6 16.65a7.5 7.5 0 0 0 10.65 0Z" />
                </svg>
            </button>

            <button class="hover:text-[#8B3A3A] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386a1.5 1.5 0 0 1 1.415 1.022L5.89 6.75m0 0h12.72a1.5 1.5 0 0 1 1.464 1.825l-1.5 7.5a1.5 1.5 0 0 1-1.464 1.175H8.39a1.5 1.5 0 0 1-1.464-1.175L5.89 6.75Zm0 0L5.25 4.5M9 21a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm10.5 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>

            <a href="{{ route('login') }}" class="hover:text-[#8B3A3A] transition" title="Masuk ke Akun">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                </svg>
            </a>
        </div>

    </div>
</header>