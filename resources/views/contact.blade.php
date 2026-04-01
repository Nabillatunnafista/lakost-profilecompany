@extends('layouts.app')

@section('title', 'Kontak – LAkost')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')

    <div class="page-header">
        <div class="container">
            <div class="page-header-inner">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>›</span>
                    <span>Kontak</span>
                </div>
                <h1>Hubungi Kami</h1>
                <p>Kami siap membantu Anda menemukan hunian terbaik di Lamongan.</p>
            </div>
        </div>
    </div>

    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">

                <div class="reveal">
                    <div class="info-intro">
                        <div class="tag">
                            <i class="fas fa-headset"></i> Get In Touch
                        </div>
                        <h2 class="section-title">Ada Pertanyaan?<br>Kami Siap Membantu!</h2>
                        <p>Jangan ragu menghubungi kami. Tim lakost siap merespons dengan cepat.</p>
                    </div>

                    <div class="info-card">
                        <div class="info-ic map">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-txt">
                            <strong>Alamat Kantor</strong>
                            <span>
                                Jl. Mendalan No.62, Banjarmendalan,<br>
                                Kec. Lamongan, Kab. Lamongan, Jawa Timur
                            </span>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-ic email">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-txt">
                            <strong>Email</strong>
                            <a href="mailto:info@lakost.id">info@lakost.id</a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-ic phone">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-txt">
                            <strong>Telepon / WhatsApp</strong>
                            <a href="https://wa.me/6285732973754" target="_blank">+62 8573-2973-754</a>
                        </div>
                    </div>

                    <div class="socials-row">
                        <h4>Ikuti Kami</h4>
                        <div class="soc-links">
                            <a href="https://www.instagram.com/_nnnfta/" target="_blank" class="soc-link ig">
                                <i class="fab fa-instagram"></i> @lakost
                            </a>
                            <a href="https://www.facebook.com/share/17WJFzHxqg/" target="_blank" class="soc-link fb">
                                <i class="fab fa-facebook-f"></i> lakost
                            </a>
                        </div>
                    </div>
                </div>

                <div class="form-box reveal">
                    <div class="form-box-head">
                        <h3>Kirim Pesan</h3>
                        <p>Isi formulir di bawah dan kami akan segera merespons Anda.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert-success">
                            <i class="fas fa-check-circle"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="req">*</span></label>
                            <input type="text" id="name" name="name"
                                class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                                value="{{ old('name') }}" 
                                placeholder="Nama lengkap Anda" 
                                autocomplete="name">
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email <span class="req">*</span></label>
                            <input type="email" id="email" name="email"
                                class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                value="{{ old('email') }}" 
                                placeholder="contoh@gmail.com" 
                                autocomplete="email">
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">Pesan <span class="req">*</span></label>
                            <textarea id="message" name="message"
                                class="form-control {{ $errors->has('message') ? 'error' : '' }}"
                                placeholder="Tulis pesan Anda">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan Sekarang
                        </button>
                    </form>
                </div> </div>
        </div>
    </section>

@endsection