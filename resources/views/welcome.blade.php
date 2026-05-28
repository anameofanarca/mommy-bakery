<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mommy Catering & Bakery</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins', sans-serif;
            background:#FFF9EC;
            color:#0A0A0A;
        }

        a{
            text-decoration:none;
        }

        .container{
            width:90%;
            max-width:1200px;
            margin:auto;
        }

        /* NAVBAR */

        nav{
            width:100%;
            background:#FFF9EC;
            border-bottom:1px solid #f0e7d7;
            padding:20px 0;
        }

        .navbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-family:'Playfair Display', serif;
            font-size:32px;
            font-weight:700;
            color:#52443E;
        }

        .menu{
            display:flex;
            gap:40px;
        }

        .menu a{
            color:#4A5565;
            font-weight:500;
        }

        .menu .active{
            color:#A43A3E;
        }

        .icons{
            display:flex;
            gap:20px;
            font-size:20px;
        }

        /* HERO */

        .hero{
            padding:80px 0;
        }

        .hero-wrapper{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:50px;
            align-items:center;
        }

        .badge{
            display:inline-block;
            background:#F2E8C5;
            color:#A43A3E;
            padding:10px 18px;
            border-radius:50px;
            margin-bottom:30px;
            font-size:14px;
            font-weight:600;
        }

        .hero h1{
            font-family:'Playfair Display', serif;
            font-size:72px;
            line-height:1.1;
            color:#451C07;
            margin-bottom:30px;
        }

        .hero p{
            color:#4A5565;
            line-height:1.9;
            margin-bottom:40px;
            max-width:550px;
        }

        .hero-buttons{
            display:flex;
            gap:20px;
        }

        .btn-primary{
            background:#A43A3E;
            color:white;
            padding:16px 32px;
            border-radius:12px;
            font-weight:600;
        }

        .btn-outline{
            border:2px solid #60311A;
            color:#60311A;
            padding:16px 32px;
            border-radius:12px;
            font-weight:600;
        }

        .hero-image{
            position:relative;
        }

        .hero-image img{
            width:100%;
            height:650px;
            object-fit:cover;
            border-radius:40px;
        }

        .floating-card{
            position:absolute;
            bottom:-20px;
            left:-20px;
            background:white;
            padding:20px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        .floating-card span{
            color:#4A5565;
            font-size:14px;
        }

        .floating-card h3{
            font-family:'Playfair Display', serif;
            color:#451C07;
            margin-top:10px;
            font-size:28px;
        }

        /* FEATURES */

        .features{
            background:#F2E8C5;
            padding:70px 0;
        }

        .feature-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
            text-align:center;
        }

        .feature-item{
            padding:20px;
        }

        .feature-icon{
            width:80px;
            height:80px;
            border-radius:50%;
            background:white;
            margin:auto;
            margin-bottom:20px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
        }

        .feature-item h3{
            font-family:'Playfair Display', serif;
            color:#60311A;
            margin-bottom:10px;
        }

        .feature-item p{
            color:#4A5565;
        }

        /* POPULAR */

        .popular{
            padding:100px 0;
        }

        .section-title{
            text-align:center;
            font-family:'Playfair Display', serif;
            font-size:54px;
            color:#451C07;
            margin-bottom:60px;
        }

        .card-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
        }

        .card img{
            width:100%;
            height:240px;
            object-fit:cover;
        }

        .card-content{
            padding:25px;
        }

        .card h3{
            font-family:'Playfair Display', serif;
            color:#451C07;
            font-size:30px;
            margin-bottom:10px;
        }

        .card p{
            color:#4A5565;
            margin-bottom:20px;
        }

        .price{
            display:block;
            margin-bottom:20px;
            color:#A43A3E;
            font-weight:700;
        }

        .card button{
            width:100%;
            border:none;
            background:#A43A3E;
            color:white;
            padding:14px;
            border-radius:12px;
            font-weight:600;
            cursor:pointer;
        }

        /* CUSTOM */

        .custom{
            padding-bottom:100px;
        }

        .custom-box{
            background:#F2E8C5;
            padding:70px;
            border-radius:40px;
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:50px;
            align-items:center;
        }

        .custom h2{
            font-family:'Playfair Display', serif;
            font-size:58px;
            line-height:1.1;
            color:#451C07;
            margin-bottom:30px;
        }

        .custom p{
            color:#4A5565;
            line-height:1.9;
            margin-bottom:30px;
        }

        .check-list{
            margin-bottom:30px;
        }

        .check-list li{
            list-style:none;
            margin-bottom:15px;
            color:#60311A;
            font-weight:500;
        }

        .custom-images{
            display:flex;
            gap:25px;
        }

        .custom-images img{
            width:50%;
            height:350px;
            object-fit:cover;
            border-radius:24px;
        }

        /* FOOTER */

        footer{
            background:#973035;
            color:white;
            padding-top:80px;
        }

        .footer-grid{
            display:grid;
            grid-template-columns:2fr 1fr 1fr;
            gap:50px;
            padding-bottom:50px;
        }

        footer h3{
            font-family:'Playfair Display', serif;
            font-size:42px;
            margin-bottom:20px;
        }

        footer h4{
            margin-bottom:20px;
            font-size:24px;
        }

        footer p,
        footer li{
            color:#fceaea;
            line-height:1.9;
        }

        footer ul{
            list-style:none;
        }

        .copyright{
            border-top:1px solid rgba(255,255,255,0.2);
            text-align:center;
            padding:25px 0;
            margin-top:30px;
            font-size:14px;
        }

        @media(max-width:992px){

            .hero-wrapper,
            .feature-grid,
            .card-grid,
            .custom-box,
            .footer-grid{
                grid-template-columns:1fr;
            }

            .hero h1{
                font-size:48px;
            }

            .section-title{
                font-size:42px;
            }

            .custom h2{
                font-size:42px;
            }

            .custom-images{
                flex-direction:column;
            }

            .custom-images img{
                width:100%;
            }

            .menu{
                display:none;
            }
        }

    </style>
</head>
<body>
    @if(session('success'))
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 1800)"
    x-show="show"
    x-transition
    style="
        position:fixed;
        top:18px;
        right:18px;
        background:#22c55e;
        color:white;
        padding:8px 14px;
        border-radius:8px;
        box-shadow:0 6px 18px rgba(0,0,0,0.1);
        z-index:9999;
        font-size:13px;
        font-weight:500;
    "
>
    Login berhasil
</div>
@endif

    <!-- NAVBAR -->

    <nav>
        <div class="container navbar">

            <div class="logo">
                Mommy Catering & Bakery
            </div>

            <div class="menu">
                <a href="#" class="active">Home</a>
                <a href="#">Menu</a>
                <a href="#">Catering</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </div>

            <div class="icons">
                <a href="/products" title="Cari produk">⌕</a>
                <a href="#" title="Keranjang" id="cart-icon">🛒</a>
                @auth

                <div x-data="{ open: false }" style="position:relative;">

                    <button 
                        @click="open = !open"
                        style="
                            background:none;
                            border:none;
                            font-size:22px;
                            cursor:pointer;
                        "
                    >
                        👤
                    </button>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        style="
                            position:absolute;
                            right:0;
                            top:40px;
                            width:140px;
                            background:white;
                            border-radius:12px;
                            overflow:hidden;
                            box-shadow:0 10px 25px rgba(0,0,0,0.1);
                            z-index:999;
                        "
                    >

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                style="
                                    width:100%;
                                    padding:12px 16px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    color:#c0392b;
                                    font-size:14px;
                                "
                            >
                                Logout
                            </button>

                        </form>

                    </div>

                </div>

                @else

                <a href="{{ route('login') }}" title="Login">👤</a>

                @endauth
            </div>

        </div>
    </nav>

    <!-- HERO -->

    <section class="hero">

        <div class="container hero-wrapper">

            <div>

                <div class="badge">
                    ♥ HOMEMADE WITH HEART
                </div>

                <h1>
                    Catering & Bakery
                    Lezat untuk setiap
                    momen spesial
                    Anda
                </h1>

                <p>
                    Nikmati kehangatan cita rasa rumahan dalam setiap gigitan.
                    Roti, kue, dan paket catering terbaik yang dibuat dengan
                    bahan premium untuk melengkapi kebahagiaan Anda.
                </p>

                <div class="hero-buttons">
                    <a href="#" class="btn-primary">Lihat Menu</a>
                    <a href="#" class="btn-outline">Pesan Sekarang</a>
                </div>

            </div>

            <div class="hero-image">

                <img src="{{ asset('images/signature-chocolate-cake.png') }}" alt="Cake">

                <div class="floating-card">
                    <span>Best Seller</span>
                    <h3>Tiramisu Cake</h3>
                </div>

            </div>

        </div>

    </section>

    <!-- FEATURES -->

    <section class="features">

        <div class="container feature-grid">

            <div class="feature-item">
                <div class="feature-icon">🏅</div>
                <h3>Bahan Premium</h3>
                <p>Kualitas terbaik di setiap adonan</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">🍰</div>
                <h3>Dibuat Fresh</h3>
                <p>Dipanggang setiap hari dengan kasih</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">🚚</div>
                <h3>Pengantaran Tepat</h3>
                <p>Sampai di tujuan tepat waktu</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">💳</div>
                <h3>Harga Terjangkau</h3>
                <p>Kualitas bintang lima, harga bersahabat</p>
            </div>

        </div>

    </section>

    <!-- POPULAR -->

    <section class="popular">

        <div class="container">

            <h2 class="section-title">
                Paket Populer
            </h2>

            <div class="card-grid">

                <div class="card">

                    <img src="{{ asset('images/nasibox.jpeg') }}" alt="Nasi Box">

                    <div class="card-content">
                        <h3>Nasi Box</h3>
                        <p>Praktis untuk acara kantor dan seminar</p>
                        <span class="price">Mulai Rp 25.000</span>
                        <button>Lihat Menu</button>
                    </div>

                </div>

                <div class="card">

                    <img src="{{ asset('images/tumpeng.jpg') }}" alt="Tumpeng">

                    <div class="card-content">
                        <h3>Tumpeng</h3>
                        <p>Cocok untuk syukuran dan acara</p>
                        <span class="price">Mulai Rp 150.000</span>
                        <button>Lihat Menu</button>
                    </div>

                </div>

                <div class="card">

                    <img src="{{ asset('images/tiramisucake.jpg') }}" alt="Prasmanan">

                    <div class="card-content">
                        <h3>Prasmanan</h3>
                        <p>Ideal untuk pernikahan dan acara besar</p>
                        <span class="price">Mulai Rp 1.250.000</span>
                        <button>Lihat Menu</button>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CUSTOM -->

    <section class="custom">

        <div class="container">

            <div class="custom-box">

                <div>

                    <h2>
                        Kustomisasi Menu
                        Sesuai Selera
                    </h2>

                    <p>
                        Punya preferensi khusus untuk acara Anda?
                        Kami melayani kustomisasi menu catering mulai dari
                        diet khusus, tema rasa, hingga dekorasi kemasan
                        yang estetik.
                    </p>

                    <ul class="check-list">
                        <li>✔ Pilihan Bahan Halal & Berkualitas</li>
                        <li>✔ Packaging Eksklusif & Higienis</li>
                        <li>✔ Layanan Server Profesional</li>
                    </ul>

                    <a href="#" class="btn-primary">
                        Buat Penawaran Custom
                    </a>

                </div>

                <div class="custom-images">

                    <img src="{{ asset('images/detail-pastry.png') }}" alt="Pastry">

                    <img src="{{ asset('images/detail-cake.png') }}" alt="Cake Detail">

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->

    <footer>

        <div class="container footer-grid">

            <div>

                <h3>Mommy Catering & Bakery</h3>

                <p>
                    Menghadirkan kehangatan masakan rumahan dengan standar
                    profesional untuk setiap acara spesial Anda.
                    Homemade with Heart.
                </p>

            </div>

            <div>

                <h4>Tautan Cepat</h4>

                <ul>
                    <li>Privacy Policy</li>
                    <li>Terms of Service</li>
                    <li>Shipping Info</li>
                    <li>FAQ</li>
                </ul>

            </div>

            <div>

                <h4>Kontak Kami</h4>

                <p>Jl. Bakri No. 12, Kebayoran Baru, Jakarta Selatan</p>
                <p>+62 812 3456 7890</p>
                <p>hello@mommycatering.com</p>

            </div>

        </div>

        <div class="copyright">
            © 2024 Mommy Catering & Bakery. Homemade with Heart.
        </div>

    </footer>

</body>
</html>