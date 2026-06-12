@extends('layouts.app')

@section('title', 'Catering - Mommy Catering & Bakery')

@section('content')

{{-- Main Wrapper to ensure everything is clean and consistent --}}
<div class="catering-page-wrapper font-beVietnam">

    {{-- Hero Section --}}
    <section class="catering-hero">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Katering Kustom untuk<br>Momen Spesial Anda</h1>
                <p>Wujudkan hidangan impian untuk setiap perayaan Anda dengan<br>sentuhan profesional dari dapur rumahan kami.</p>
            </div>
        </div>
    </section>

    {{-- Content Section (Why & Form centered together) --}}
    <div class="catering-main-content">
        
        {{-- Why Custom Catering --}}
        <section class="catering-why">
            <div class="form-container">
                <div class="why-card">
                    <h2>Kenapa Custom Catering?</h2>
                    <ul class="why-list">
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Menu disesuaikan dengan tema dan preferensi Anda</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Fleksibel untuk budget dan porsi yang diinginkan</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Konsultasi langsung dengan chef berpengalaman</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Cocok untuk acara pernikahan, corporate, gathering, dll</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Catering Form --}}
        <section class="catering-form-section">
            <div class="form-container">
                <div class="form-card">
                    <h2 class="form-title">Informasi Acara</h2>

                    <form id="cateringForm" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama lengkap Anda" required>
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                            </div>
                            <div class="form-group">
                                <label for="no_whatsapp">No. WhatsApp <span class="required">*</span></label>
                                <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control" placeholder="Contoh: 08123456789" required>
                                <div class="invalid-feedback">Nomor WhatsApp wajib diisi.</div>
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="alamat@email.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_acara">Jenis Acara <span class="required">*</span></label>
                                <input type="text" id="jenis_acara" name="jenis_acara" class="form-control" placeholder="Contoh: Pernikahan, Corporate" required>
                                <div class="invalid-feedback">Jenis acara wajib diisi.</div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_tamu">Jumlah Tamu <span class="required">*</span></label>
                                <input type="number" id="jumlah_tamu" name="jumlah_tamu" class="form-control" placeholder="Contoh: 50" min="1" required>
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
                                    <input type="text" id="budget" name="budget" class="form-control" placeholder="5.000.000">
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
    </div>
</div>

{{-- Styles --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

    .font-beVietnam {
        font-family: 'Be Vietnam Pro', sans-serif;
    }

    .catering-page-wrapper {
        background: #faf8f3;
        width: 100%;
        min-height: 100vh;
    }

    /* ── Hero ── */
    .catering-hero {
        position: relative;
        width: 100%;
        height: 320px;
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset("images/catering-banner.png") }}') center/cover no-repeat;
        background-color: #5c3d2e;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 2rem;
    }

    .hero-content {
        max-width: 1200px;
        width: 100%;
        text-align: left;
    }

    .hero-content h1 {
        font-size: 2.25rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.3;
        margin-bottom: .8rem;
    }

    .hero-content p {
        color: rgba(255,255,255,.9);
        font-size: 1rem;
        line-height: 1.6;
    }

    /* ── Main Content Layout Centerer ── */
    .catering-main-content {
        display: flex;
        flex-direction: column;
        align-items: center; /* Membuat semua section otomatis ke tengah */
        justify-content: center;
        width: 100%;
        padding: 3rem 1rem;
        box-sizing: border-box;
    }

    .form-container {
        width: 100%;
        max-width: 720px; /* Lebar card diperlebar sedikit agar lebih lega & rapi */
        margin: 0 auto;
    }

    /* ── Why Card ── */
    .catering-why {
        width: 100%;
        margin-bottom: 2rem;
    }

    .why-card {
        background: #f0ebe0;
        border-radius: 16px;
        padding: 2.2rem 2.5rem;
        border: 1px solid #e4ded2;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .why-card h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #A43A3E; /* Menggunakan primary brand color kamu */
        margin-bottom: 1.2rem;
    }

    .why-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .why-list li {
        display: flex;
        align-items: flex-start;
        gap: .8rem;
        font-size: .95rem;
        color: #52443E;
    }

    .check-icon {
        color: #A43A3E;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ── Form Section ── */
    .catering-form-section {
        width: 100%;
    }

    .form-card {
        background: #f0ebe0;
        border-radius: 16px;
        padding: 2.5rem;
        border: 1px solid #e4ded2;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }

    .form-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #A43A3E;
        margin-bottom: 1.8rem;
        border-bottom: 2px solid #e4ded2;
        padding-bottom: .5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: .45rem;
    }

    .form-group.full-width {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        font-size: .88rem;
        font-weight: 600;
        color: #52443E;
    }

    .required {
        color: #A43A3E;
    }

    .form-control {
        background: #fffaf4; /* Menyamakan dengan warna form login kamu */
        border: 1px solid #ddd6c8;
        border-radius: 8px;
        padding: .75rem 1rem;
        font-size: .92rem;
        color: #222;
        transition: all .2s ease-in-out;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #A43A3E;
        box-shadow: 0 0 0 3px rgba(164,58,62, 0.15);
    }

    .form-control::placeholder {
        color: #b5aba0;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .invalid-feedback {
        display: none;
        font-size: .8rem;
        color: #dc3545;
        margin-top: 2px;
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
        color: #776a61;
        font-size: .92rem;
        font-weight: 600;
        z-index: 2;
    }

    .budget-input .form-control {
        padding-left: 42px;
    }

    /* ── WhatsApp Button ── */
    .btn-whatsapp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .7rem;
        width: 100%;
        background: #25D366;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: .95rem 1rem;
        font-size: 1.05rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 2rem;
        transition: all .2s ease;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
    }

    .btn-whatsapp:hover {
        background: #1ebe5d;
        box-shadow: 0 6px 15px rgba(37, 211, 102, 0.3);
        transform: translateY(-1px);
    }

    .btn-whatsapp:active {
        transform: scale(.99);
    }

    .wa-icon {
        flex-shrink: 0;
    }

    /* ── Responsive Mobile ── */
    @media (max-width: 640px) {
        .hero-overlay {
            justify-content: flex-start;
            padding: 0 1.5rem;
        }
        .hero-content h1 { font-size: 1.6rem; }
        .hero-content p { font-size: .88rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .why-card, .form-card { padding: 1.5rem 1.25rem; }
        .catering-main-content { padding: 1.5rem .5rem; }
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

    if (!valid) {
        // Scroll smoothly to the first error input
        const firstInvalid = document.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
    }

    // Gather values
    const nama       = document.getElementById('nama_lengkap').value.trim();
    const wa         = document.getElementById('no_whatsapp').value.trim();
    const email      = document.getElementById('email').value.trim();
    const jenis      = document.getElementById('jenis_acara').value.trim();
    const tamu       = document.getElementById('jumlah_tamu').value.trim();
    const tanggal    = document.getElementById('tanggal_acara').value.trim();
    const budget     = document.getElementById('budget').value.replace(/\D/g, '').trim();
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

    // Actual WhatsApp number 
    const waNumber = '6282322496181';
    const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;

    fetch('/catering/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
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