@extends('layouts.app')

@section('content')
    <section class="cart-empty-page">
        <div class="cart-empty-box">
            <div class="cart-empty-icon">
                <svg width="90" height="90" viewBox="0 0 24 24" fill="none">
                    <path d="M6 7L8 3H16L18 7" stroke="#d1d5db" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 7H19V18C19 19.1 18.1 20 17 20H7C5.9 20 5 19.1 5 18V7Z" stroke="#d1d5db" stroke-width="1.6" stroke-linejoin="round"/>
                    <path d="M9 11C9 12.657 10.343 14 12 14C13.657 14 15 12.657 15 11" stroke="#d1d5db" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </div>

            <h1>Keranjang Kosong</h1>
            <p>Belum ada produk yang ditambahkan</p>

            <a href="{{ route('menu.index') }}" class="cart-empty-btn">
                Mulai Belanja
            </a>
        </div>
    </section>
@endsection