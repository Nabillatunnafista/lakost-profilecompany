@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<style>
    /* Styling khusus untuk header section dan tombol Lihat Semua */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 5px;
    }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background-color: transparent;
        color: #1e3a8a; /* Warna biru navy sesuai tema LAkost */
        border: 1.5px solid #1e3a8a;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-view-all:hover {
        background-color: #1e3a8a;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(30, 58, 138, 0.15);
        transform: translateY(-2px);
    }

    .btn-view-all i {
        margin-left: 8px;
        font-size: 0.75rem;
        transition: transform 0.3s ease;
    }

    .btn-view-all:hover i {
        transform: translateX(4px);
    }

    /* Penyesuaian heading agar sejajar */
    .section-heading {
        margin-bottom: 0 !important;
        font-weight: 700;
        color: #334155;
    }
</style>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card stat-users">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Users</span>
            <strong class="stat-value">{{ $totalUsers ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-kost">
        <div class="stat-icon"><i class="fas fa-home"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Kost</span>
            <strong class="stat-value">{{ $totalKost ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-kategori">
        <div class="stat-icon"><i class="fas fa-tags"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Kategori</span>
            <strong class="stat-value">{{ $totalKategori ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-wilayah">
        <div class="stat-icon"><i class="fas fa-map-marker-alt"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Wilayah</span>
            <strong class="stat-value">{{ $totalWilayah ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-putra">
        <div class="stat-icon"><i class="fas fa-male"></i></div>
        <div class="stat-info">
            <span class="stat-label">Kost Putra</span>
            <strong class="stat-value">{{ $kostPutra ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-putri">
        <div class="stat-icon"><i class="fas fa-female"></i></div>
        <div class="stat-info">
            <span class="stat-label">Kost Putri</span>
            <strong class="stat-value">{{ $kostPutri ?? 0 }}</strong>
        </div>
    </div>
    <div class="stat-card stat-campur">
        <div class="stat-icon"><i class="fas fa-people-arrows"></i></div>
        <div class="stat-info">
            <span class="stat-label">Kost Campur</span>
            <strong class="stat-value">{{ $kostCampur ?? 0 }}</strong>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="dashboard-section" style="margin-top: 30px;">
    <h3 class="section-heading" style="margin-bottom: 15px;">Akses Cepat</h3>
    <div class="quick-links">
        <a href="{{ route('admin.kost.create') }}" class="quick-link">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah Kost</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="quick-link">
            <i class="fas fa-user-plus"></i>
            <span>Kelola Users</span>
        </a>
        <a href="{{ route('admin.wilayah.index') }}" class="quick-link">
            <i class="fas fa-map"></i>
            <span>Kelola Wilayah</span>
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="quick-link">
            <i class="fas fa-layer-group"></i>
            <span>Kelola Kategori</span>
        </a>
    </div>
</div>

{{-- Recent Kost Table --}}
<div class="dashboard-section" style="margin-top: 30px;">
    <div class="section-header">
        <h3 class="section-heading">Kost Terbaru</h3>
        <a href="{{ route('admin.kost.index') }}" class="btn-view-all">
            Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Kost</th>
                    <th>Kategori</th>
                    <th>Wilayah</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentKost ?? [] as $kost)
                <tr>
                    <td><strong>{{ $kost->nama_kost }}</strong></td>
                    <td><span class="badge-kategori">{{ $kost->kategori->nama_kategori ?? '-' }}</span></td>
                    <td>{{ $kost->wilayah->nama_kecamatan ?? '-' }}</td>
                    <td>Rp {{ number_format($kost->harga, 0, ',', '.') }}/bln</td>
                    <td>
                        <span class="badge-status {{ $kost->status === 'tersedia' ? 'available' : 'full' }}">
                            {{ ucfirst($kost->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.kost.edit', $kost->id) }}" class="btn-action edit"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="table-empty">Belum ada data kost</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection