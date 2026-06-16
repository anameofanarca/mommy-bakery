@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8F4EC] py-12 px-6">
    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-3xl shadow-sm border border-[#E5DED3] overflow-hidden">

            <div class="bg-[#FEF4D0] px-8 py-8 border-b border-[#E5DED3]">
                <h1 class="text-3xl font-bold text-[#4A2C2A] font-[Playfair_Display]">
                    My Profile
                </h1>
                <p class="text-[#7A5C4A] mt-2">
                    Informasi akun kamu di Mommy Catering & Bakery
                </p>
            </div>

            <div class="p-8">

                @if(session('success'))
                    <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex items-center gap-6 mb-8">
                    <div class="w-24 h-24 rounded-full bg-[#8B3A3A] flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-[#4A2C2A]">
                            {{ $user->name }}
                        </h2>
                        <p class="text-[#7A5C4A]">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                Nama
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A]"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A]"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                No. WhatsApp
                            </label>
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                placeholder="Contoh: 082322496181"
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A]"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                Kota
                            </label>
                            <input
                                type="text"
                                name="city"
                                value="{{ old('city', $user->city) }}"
                                placeholder="Contoh: Bandung"
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A]"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                Kode Pos
                            </label>
                            <input
                                type="text"
                                name="postal_code"
                                value="{{ old('postal_code', $user->postal_code) }}"
                                placeholder="Contoh: 40257"
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A]"
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-[#4A2C2A] mb-2">
                                Alamat Lengkap
                            </label>
                            <textarea
                                name="address"
                                rows="4"
                                placeholder="Masukkan alamat lengkap kamu"
                                class="w-full rounded-xl border border-[#E5DED3] px-4 py-3 bg-[#FDFBF7] text-[#52443E] focus:outline-none focus:border-[#8B3A3A] resize-none"
                            >{{ old('address', $user->address) }}</textarea>

                            <p class="text-xs text-[#7A5C4A] mt-2">
                                Data ini akan otomatis terisi saat checkout, tapi tetap bisa diubah sebelum memesan.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <button type="submit"
                                class="px-6 py-3 rounded-xl bg-[#8B3A3A] text-white font-semibold hover:bg-[#6F2E2E] transition">
                            Simpan Perubahan
                        </button>

                        <a href="{{ url('/') }}"
                           class="px-6 py-3 rounded-xl border border-[#8B3A3A] text-[#8B3A3A] font-semibold hover:bg-[#FEF4D0] transition">
                            Kembali ke Home
                        </a>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
@endsection