@extends('layouts.app')

@section('title', 'Catering - Mommy Catering & Bakery')

@section('content')

{{-- Hero Section --}}
<section class="catering-hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Katering Kustom untuk<br>Momen Spesial Anda</h1>
            <p>Wujudkan hidangan impian untuk setiap perayaan Anda dengan<br>sentuhan profesional dari dapur rumahan kami.</p>
        </div>
    </div>
</section>

{{-- Why Custom Catering --}}
<section class="catering-why">
    <div class="container">
        <div class="why-card">
            <h2>Kenapa Custom Catering?</h2>
            <ul class="why-list">
                <li>
                    <span class="check-icon">✓</span>
                    Menu disesuaikan dengan tema dan preferensi Anda
                </li>
                <li>
                    <span class="check-icon">✓</span>
                    Fleksibel untuk budget dan porsi yang diinginkan
                </li>
                <li>
                    <span class="check-icon">✓</span>
                    Konsultasi langsung dengan chef berpengalaman
                </li>
                <li>
                    <span class="check-icon">✓</span>
                    Cocok untuk acara pernikahan, corporate, gathering, dll
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- Catering Form --}}
<section class="catering-form-section">
    <div class="container">
        <div class="form-card">
            <h2 class="form-title">Informasi Acara</h2>

            <form id="cateringForm" novalidate>
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
                        <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp">No. WhatsApp <span class="required">*</span></label>
                        <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control" placeholder="08123456789" required>
                        <div class="invalid-feedback">Nomor WhatsApp wajib diisi.</div>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_acara">Jenis Acara <span class="required">*</span></label>
                        <input type="text" id="jenis_acara" name="jenis_acara" class="form-control" placeholder="Contoh: Pernikahan, Corporate" required>
                        <div class="invalid-feedback">Jenis acara wajib diisi.</div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_tamu">Jumlah Tamu <span class="required">*</span></label>
                        <input type="number" id="jumlah_tamu" name="jumlah_tamu" class="form-control" placeholder="50" min="1" required>
                        <div class="invalid-feedback">Jumlah tamu wajib diisi.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tanggal_acara">Tanggal Acara <span class="required">*</span></label>
                        <input type="date" id="tanggal_acara" name="tanggal_acara" class="form-control" required>
                        <div class="invalid-feedback">Tanggal acara wajib diisi.</div>
                    </div>
                    <div class="form-group">
                        <label for="budget">Budget (estimasi)</label>

                        <div class="budget-input">
                            <span class="currency-icon">Rp</span>
                            <input
                                type="text"
                                id="budget"
                                name="budget"
                                class="form-control"
                                placeholder="5.000.000">
                        </div>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="preferensi_menu">Preferensi Menu <span class="required">*</span></label>
                    <textarea id="preferensi_menu" name="preferensi_menu" class="form-control" rows="3"
                        placeholder="Contoh: Menu Indonesia, halal, tidak pedas, ada opsi vegetarian" required></textarea>
                    <div class="invalid-feedback">Preferensi menu wajib diisi.</div>
                </div>

                <div class="form-group full-width">
                    <label for="catatan_tambahan">Catatan Tambahan</label>
                    <textarea id="catatan_tambahan" name="catatan_tambahan" class="form-control" rows="3"
                        placeholder="Informasi tambahan yang perlu kami ketahui"></textarea>
                </div>

                <button type="submit" class="btn-whatsapp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="wa-icon">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                    Kirim Melalui WhatsApp
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Styles --}}
<style>
    /* ── Hero ── */
    .catering-hero {
        position: relative;
        width: 100%;
        height: 280px;
        background: url('{{ asset("images/catering-banner.png") }}') center/cover no-repeat;
        background-color: #5c3d2e; /* fallback */
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.15) 100%);
        display: flex;
        align-items: center;
        padding: 0 3rem;
    }

    .hero-content h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.3;
        margin-bottom: .6rem;
    }

    .hero-content p {
        color: rgba(255,255,255,.85);
        font-size: .95rem;
        line-height: 1.6;
    }

    /* ── Why Card ── */
    .catering-why {
        background: #faf8f3;
        padding: 2.5rem 0;
    }

    .why-card {
        background: #f0ebe0;
        border-radius: 12px;
        padding: 2rem 2.2rem;
        max-width: 680px;
        margin: 0 auto;
    }

    .why-card h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .why-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: .55rem;
    }

    .why-list li {
        display: flex;
        align-items: flex-start;
        gap: .6rem;
        font-size: .92rem;
        color: #333;
    }

    .check-icon {
        color: #8b1a1a;
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── Form Section ── */
    .catering-form-section {
        background: #faf8f3;
        padding: 0 0 3rem;
    }

    .form-card {
        background: #f0ebe0;
        border-radius: 12px;
        padding: 2rem 2.2rem 2.5rem;
        max-width: 680px;
        margin: 0 auto;
    }

    .form-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: .35rem;
    }

    .form-group.full-width {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-size: .85rem;
        font-weight: 600;
        color: #222;
    }

    .required {
        color: #8b1a1a;
    }

    .form-control {
        background: #faf8f2;
        border: 1px solid #ddd6c8;
        border-radius: 6px;
        padding: .55rem .8rem;
        font-size: .9rem;
        color: #222;
        transition: border-color .2s;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #8b1a1a;
        box-shadow: 0 0 0 3px rgba(139,26,26,.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: none;
        font-size: .78rem;
        color: #dc3545;
    }

    .form-control.is-invalid + .invalid-feedback {
        display: block;
    }

    textarea.form-control {
        resize: vertical;
    }

    .budget-input {
    position: relative;
    }

    .currency-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: .9rem;
        font-weight: 600;
        z-index: 2;
    }

    .budget-input .form-control {
        padding-left: 45px;
    }

    /* ── WhatsApp Button ── */
    .btn-whatsapp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .6rem;
        width: 100%;
        background: #25D366;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: .85rem 1rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 1.5rem;
        transition: background .2s, transform .1s;
    }

    .btn-whatsapp:hover {
        background: #1ebe5d;
    }

    .btn-whatsapp:active {
        transform: scale(.98);
    }

    .wa-icon {
        flex-shrink: 0;
    }

    /* ── Responsive ── */
    @media (max-width: 640px) {
        .hero-content h1 { font-size: 1.4rem; }
        .form-row { grid-template-columns: 1fr; }
        .hero-overlay { padding: 0 1.2rem; }
        .why-card, .form-card { padding: 1.4rem 1.2rem; }
    }
</style>

{{-- Script: build WhatsApp message from form data --}}
<script>
document.getElementById('cateringForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Simple validation
    let valid = true;
    const required = this.querySelectorAll('[required]');
    required.forEach(function(field) {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            valid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!valid) return;

    // Gather values
    const nama       = document.getElementById('nama_lengkap').value.trim();
    const wa         = document.getElementById('no_whatsapp').value.trim();
    const email      = document.getElementById('email').value.trim();
    const jenis      = document.getElementById('jenis_acara').value.trim();
    const tamu       = document.getElementById('jumlah_tamu').value.trim();
    const tanggal    = document.getElementById('tanggal_acara').value.trim();
    const budget = document.getElementById('budget').value.replace(/\./g, '').trim();
    const preferensi = document.getElementById('preferensi_menu').value.trim();
    const catatan    = document.getElementById('catatan_tambahan').value.trim();

    // Format budget as IDR if filled
    let budgetFormatted = budget
        ? 'Rp ' + Number(budget).toLocaleString('id-ID')
        : '-';

    // Format tanggal
    let tanggalFormatted = tanggal
        ? new Date(tanggal).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' })
        : '-';

    const message =
`Halo Mommy Catering & Bakery! Saya ingin memesan layanan catering kustom.

*Nama Lengkap:* ${nama}
*No. WhatsApp:* ${wa}
*Email:* ${email || '-'}
*Jenis Acara:* ${jenis}
*Jumlah Tamu:* ${tamu} orang
*Tanggal Acara:* ${tanggalFormatted}
*Budget Estimasi:* ${budgetFormatted}
*Preferensi Menu:* ${preferensi}
*Catatan Tambahan:* ${catatan || '-'}

Mohon informasi lebih lanjut. Terima kasih!`;

    // Replace with your actual WhatsApp number (without +)
    const waNumber = '6282322496181';
    const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;

    fetch('/catering/store', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector(
            'input[name="_token"]'
        ).value
    },
        body: JSON.stringify({
            nama_lengkap: nama,
            no_whatsapp: wa,
            email: email,
            jenis_acara: jenis,
            jumlah_tamu: tamu,
            tanggal_acara: tanggal,
            budget: budget,
            preferensi_menu: preferensi,
            catatan_tambahan: catatan
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.open(waUrl, '_blank');
        }
    });
});

const budgetInput = document.getElementById('budget');

budgetInput.addEventListener('input', function () {
    let value = this.value.replace(/\D/g, '');

    this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});

document.querySelectorAll('.form-control').forEach(function(el) {
    el.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
});
</script>

@endsection