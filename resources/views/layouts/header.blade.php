<header class="border-b border-[#E5DED3] bg-[#F8F4EC]">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <!-- LOGO -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition">
            <img 
                src="{{ asset('images/Icon.png') }}" 
                alt="Mommy Bakery Logo" 
                class="w-10 h-10 object-contain"
            >

            <h1 class="text-2xl font-bold font-[Playfair_Display] text-[#4A2C2A]">
                Mommy Catering & Bakery
            </h1>
        </a>

        <!-- MENU -->
        <nav class="hidden md:flex gap-8 text-sm font-medium text-[#52443E]">

            <a href="{{ url('/') }}"
               class="hover:text-[#8B3A3A] transition">
                Home
            </a>

            <a href="{{ url('/products') }}"
               class="hover:text-[#8B3A3A] transition">
                Menu
            </a>

            <a href="{{ url('/products') }}"
               class="hover:text-[#8B3A3A] transition">
                Catering
            </a>

            <a href="#about"
               class="hover:text-[#8B3A3A] transition">
                About
            </a>

            <a href="#contact"
               class="hover:text-[#8B3A3A] transition">
                Contact
            </a>

        </nav>

        <!-- ICONS -->
        <div class="flex items-center gap-5 text-[#4A2C2A]">

            <!-- SEARCH -->
            <a href="{{ url('/products') }}"
               class="hover:text-[#8B3A3A] transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="w-5 h-5">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6 16.65a7.5 7.5 0 0 0 10.65 0Z" />
                </svg>

            </a>

            <!-- CART -->
            @auth
                <a href="/cart"
                   class="hover:text-[#8B3A3A] transition">
            @else
                <a href="{{ route('login') }}"
                   class="hover:text-[#8B3A3A] transition">
            @endauth

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="w-5 h-5">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M2.25 3h1.386a1.5 1.5 0 0 1 1.415 1.022L5.89 6.75m0 0h12.72a1.5 1.5 0 0 1 1.464 1.825l-1.5 7.5a1.5 1.5 0 0 1-1.464 1.175H8.39a1.5 1.5 0 0 1-1.464-1.175L5.89 6.75Zm0 0L5.25 4.5M9 21a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm10.5 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </a>

            <!-- PROFILE -->
            @auth

            <div x-data="{ open: false }" class="relative">

                <button @click="open = ! open"
                        class="hover:text-[#8B3A3A] transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.7"
                         stroke="currentColor"
                         class="w-6 h-6">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                    </svg>

                </button>

                <!-- DROPDOWN -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-3 w-36 bg-white rounded-xl shadow-xl overflow-hidden z-50"
                >

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-gray-100 transition"
                        >
                            Logout
                        </button>

                    </form>

                </div>

            </div>

            @else

            <a href="{{ route('login') }}"
               class="hover:text-[#8B3A3A] transition"
               title="Masuk ke Akun">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.7"
                     stroke="currentColor"
                     class="w-6 h-6">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
 d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                </svg>

            </a>

            @endauth

        </div>

    </div>
</header>