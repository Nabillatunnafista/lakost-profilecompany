<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO --}}
    <title>@yield('title', 'LAkost - Solusi Hunian Lamongan')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="description" content="@yield('meta_desc', 'Platform penghubung pencari kos dan pemilik hunian di Lamongan — aman, mudah, dan transparan.')">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Icons (Font Awesome) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Global CSS (main.css) --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Page-specific CSS (untuk home.css, etc.) --}}
    @stack('styles')
</head>
<body>

{{-- ═══ NAVBAR ═══ --}}
<nav id="navbar">
    <a href="{{ route('home') }}" class="nav-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo lakost" class="nav-logo-img">
    </a>

    {{-- Hamburger (Mobile) --}}
    <button class="hamburger" id="hamburger" aria-label="Buka menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>

    {{-- Link Navigasi --}}
    <ul class="nav-links" id="nav-links">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('home') }}#layanan">Layanan</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
        <li>
            <a href="https://wa.me/6285732973754" target="_blank" class="btn btn-wa btn-cta">
                <i class="fab fa-whatsapp"></i> Hubungi Kami
            </a>
        </div>
    </ul>
</nav>

{{-- ═══ CONTENT ═══ --}}
<main>@yield('content')</main>

{{-- ═══ FOOTER ═══ --}}
<footer>
    <div class="container">
        <div class="footer-grid">
            
            {{-- Bagian About (Kiri) --}}
            <div class="footer-about">
                <div class="nav-brand">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo lakost" class="nav-logo-img">
                </div>
                <ul class="team-names">
                    <li><strong>TEAM PENGEMBANG LAKOST</strong></li>
                    <li>Angelina Safara - frontend developer</li>
                    <li>Alsahera Ramadhan nesa - Backend developer</li>
                    <li>Nabillatun Nafista - UI/UX Designer</li><br>
                </ul>

                <div class="footer-socials">
                    <a href="https://www.instagram.com/_nnnfta/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/share/17WJFzHxqg/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/6285732973754" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            {{-- Kolom Navigasi (Tengah) --}}
            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}#layanan">Layanan</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Kolom Kontak (Kanan) --}}
            <div class="footer-col">
                <h4>Kontak</h4>
                <div class="footer-info-item"><i class="fas fa-map-marker-alt"></i><span>Jl. Mendalan No.62, Banjarmendalan, Kec. Lamongan, Kab. Lamongan, Jawa Timur</span></div>
                <div class="footer-info-item"><i class="fas fa-envelope"></i><a href="mailto:info@lakost.id">info@lakost.id</a></div>
                <div class="footer-info-item"><i class="fas fa-phone"></i><a href="https://wa.me/6285732973754" target="_blank">+62 857-3297-3754</a></div>
            </div>
        </div>

        {{-- Hak Cipta (Paling Bawah) --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} lakost. Hak Cipta Dilindungi. Dibuat dengan ♥ di Lamongan.</p>
        </div>
    </div>
</footer>

{{-- Global JS (app.js) --}}
<script src="{{ asset('js/app.js') }}"></script>

{{-- Page-specific JS --}}
@stack('scripts')
</body>
</html>