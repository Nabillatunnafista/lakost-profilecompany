@extends('layouts.app')

@section('title', 'Lakost – Solusi Hunian Terpercaya di Lamongan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

{{-- ═══ HERO SECTION ═══ --}}
<section class="hero">
    <div class="container">
        <div class="hero-wrapper">
            
            {{-- SISI KIRI: TEKS --}}
            <div class="hero-left">
                <h1 class="hero-title">
                    Solusi Hunian<br><em>Terpercaya</em> di Lamongan
                </h1>
                <p class="hero-sub">
                    Platform penghubung pencari kos dan pemilik hunian di Lamongan yang aman, mudah, dan transparan. Temukan hunian strategis di pusat kota dan area perkantoran Lamongan sekarang.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('about') }}" class="btn btn-primary">
                        Pelajari Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="https://wa.me/6285732973754" target="_blank" class="btn btn-outline">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="hero-right">
        <div class="photo-mask">
            <img src="{{ asset('images/lakost.png') }}" alt="Hunian lakost">
        </div>
    </div>
</section>

{{-- ═══ LAYANAN ═══ --}}
<section class="services section" id="layanan">
    <div class="container">
        <div class="text-center reveal">
            <div class="tag"><i class="fas fa-star"></i> Layanan Kami</div>
            <h2 class="section-title">Apa yang lakost Tawarkan?</h2>
            <p class="section-sub">Kami hadir untuk menjembatani kebutuhan hunian dengan solusi digital yang mudah, cepat, dan aman.</p>
        </div>
        <div class="svc-grid">
            <div class="card svc-card reveal">
                <div class="svc-icon svc-icon-1"><i class="fas fa-search"></i></div>
                <h3>Pencarian Mudah</h3>
                <p>Membantu pendatang menemukan lokasi kos strategis di Lamongan dengan filter lengkap dan informasi detail.</p>
            </div>
            <div class="card svc-card reveal">
                <div class="svc-icon svc-icon-2"><i class="fas fa-bullhorn"></i></div>
                <h3>Promosi Kos</h3>
                <p>Membantu pemilik kos menjangkau calon penyewa lebih luas melalui platform digital yang teroptimasi.</p>
            </div>
            <div class="card svc-card reveal">
                <div class="svc-icon svc-icon-3"><i class="fas fa-shield-alt"></i></div>
                <h3>Verifikasi Data</h3>
                <p>Menjamin keamanan informasi hunian agar bebas dari penipuan dan data yang tidak valid.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ AREA CAKUPAN ═══ --}}
<section class="areas section">
    <div class="container">
        <div class="text-center reveal">
            <div class="tag"><i class="fas fa-map-marker-alt"></i> Area Cakupan</div>
            <h2 class="section-title">Jangkauan di Seluruh Lamongan</h2>
            <p class="section-sub">Kami melayani berbagai kecamatan strategis di Kabupaten Lamongan.</p>
        </div>
        <div class="areas-grid">
            @foreach($areas as $area)
            <div class="area-item reveal">
                <div class="area-ic"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <h4>{{ $area->name }}</h4>
                    @if($area->description)
                        <p>{{ $area->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ CTA BANNER (FULL WIDTH) ═══ --}}
<section class="cta-banner">
    <div class="container">
        <div class="cta-row">
            <div class="cta-text-wrapper reveal">
                <h2>Siap Menemukan Hunian Impianmu?</h2>
                <p>Tim kami siap membantu menemukan kos terbaik di Lamongan.</p>
            </div>
            <div class="cta-btns-wrapper reveal">
                <a href="https://wa.me/6285732973754" target="_blank" class="btn btn-wa">
                    <i class="fab fa-whatsapp"></i> Chat WhatsApp
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline">
                    Kirim Pesan <i class="fas fa-paper-plane"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
