@extends('layouts.app')

@section('title', 'Tentang Kami - lakost')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

{{-- ═══ PAGE HEADER ═══ --}}
<div class="page-header">
    <div class="container">
        <div class="page-header-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span></span>
                <span>About Us</span>
            </div>
            <h1>Tentang lakost</h1>
            <p>Mengenal lebih dalam platform hunian digital dari Lamongan untuk Lamongan.</p>
        </div>
    </div>
</div>

{{-- ═══ STORY ═══ --}}
<section class="story">
    <div class="container">
        <div class="story-grid">

            {{-- Visual --}}
            <div class="story-visual reveal">
                <div class="story-box">
                    <div class="story-box-inner">
                        <i class="fas fa-city"></i>
                        <h3>Lahir dari Lamongan</h3>
                        <p>Sejak 2026, kami hadir untuk masyarakat</p>
                    </div>
                </div>
                <div class="story-badge">
                    <div class="badge-icon"><i class="fas fa-award"></i></div>
                    <div class="badge-text">
                        <strong>4+ bulan</strong>
                        <span>Melayani Lamongan</span>
                    </div>
                </div>
            </div>

            {{-- Text --}}
            <div class="reveal">
                <div class="tag"><i class="fas fa-book-open"></i> Cerita Kami</div>
                <h2 class="section-title">Dari Masalah Nyata,<br>Lahirlah lakost</h2>
                <div class="story-text">
                    <p>lakost bermula dari keresahan sederhana — seorang mahasiswa pendatang yang kesulitan menemukan tempat tinggal layak di Lamongan. Informasi kos tersebar tidak merata, banyak yang tidak akurat, bahkan beberapa berujung penipuan.</p>
                    <blockquote class="story-quote">
                        "Kami percaya setiap orang berhak mendapatkan akses informasi hunian yang jujur, mudah, dan terpercaya — di mana pun mereka berada."
                    </blockquote>
                    <p>Didirikan tahun 2026, lakost hadir sebagai jembatan digital antara pemilik kos dan pencari hunian di Lamongan. Hari ini, kami telah membantu mahasiswa dan para pekerja menemukan hunian ideal mereka.</p>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    Hubungi Kami <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ═══ VISI & MISI ═══ --}}
<section class="visi">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom:52px">
            <div class="tag tag-white"><i class="fas fa-compass"></i> Visi &amp; Misi</div>
            <h2 class="section-title" style="color:var(--white)">Arah Perjalanan lakost</h2>
            <p class="section-sub" style="color:rgba(255,255,255,.62)">Tujuan besar yang menjadi kompas setiap langkah yang kami ambil.</p>
        </div>
        <div class="visi-grid">
            <div class="visi-card reveal">
                <div class="visi-icon vision"><i class="fas fa-eye"></i></div>
                <h3>Visi</h3>
                <p>Menjadi pusat informasi hunian terbesar dan paling terpercaya di Lamongan, sebagai referensi utama dalam mencari dan mempromosikan kos-kosan.</p>
            </div>
            <div class="visi-card reveal">
                <div class="visi-icon mission"><i class="fas fa-rocket"></i></div>
                <h3>Misi</h3>
                <ul class="misi-list">
                    <li><i class="fas fa-check-circle"></i> Melakukan digitalisasi kos-kosan di seluruh penjuru Lamongan.</li>
                    <li><i class="fas fa-check-circle"></i> Mempermudah akses hunian bagi mahasiswa dan pekerja.</li>
                    <li><i class="fas fa-check-circle"></i> Memberdayakan pemilik kos lokal di era digital.</li>
                    <li><i class="fas fa-check-circle"></i> Membangun ekosistem properti yang sehat dan bebas penipuan.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
