@extends('layouts.app')

@section('content')

<section class="contact-section">
    <div class="contact-title">
        <h1>Hubungi Kami</h1>
        <p>
            Berencana Mengadakan Acara Spesial atau Sekedar Menanyakan Catering & Bakery?
            <br>
            Kami Siap Menemani Momen Manis Anda
        </p>
    </div>

    <div class="contact-container">

        <div class="contact-info">

            <div class="info-card address-card">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2"/>
                    </svg>
                </div>

                <div>
                    <h3>Alamat Utama</h3>
                    <p>
                        Jl. Dengkek Raya No. 12,<br>
                        Pati, Jawa Tengah
                    </p>
                </div>
            </div>

            <div class="info-card contact-small">
                <div class="contact-item">
                    <div class="icon-box pink">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="12" height="20" x="6" y="2" rx="2" ry="2"/>
                            <line x1="12" x2="12.01" y1="18" y2="18"/>
                        </svg>
                    </div>

                    <div>
                        <span>WhatsApp</span>
                        <h4>
                            <a href="https://wa.me/6282322496181" target="_blank">
                                +62 823-2249-6181
                            </a>
                        </h4>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-10 6L2 7"/>
                        </svg>
                    </div>

                    <div>
                        <span>Email</span>
                        <h4>
                            <a href="mailto:mommyybakery@gmail.com">
                                mommyybakery@gmail.com
                            </a>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3 class="hours-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Jam Operasional
                </h3>

                <div class="hours-row">
                    <span>Senin - Jumat</span>
                    <span>07:00 - 19:00</span>
                </div>

                <div class="hours-row">
                    <span>Sabtu</span>
                    <span>08:00 - 17:00</span>
                </div>

                <div class="hours-row">
                    <span>Minggu</span>
                    <strong>Hanya Pesanan Khusus</strong>
                </div>
            </div>

        </div>

        <div class="map-box">
    <a href="https://share.google/ma1wI5a8T1VVKyHmx"
       target="_blank">
        <img src="{{ asset('images/MapPlaceholder.png') }}"
             alt="Lokasi Mommy Catering & Bakery">
    </a>
</div>

    </div>
</section>

@endsection