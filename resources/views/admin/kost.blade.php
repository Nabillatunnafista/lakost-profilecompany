@extends('layouts.admin')

@section('title', 'Kelola Data Kost')
@section('page_title', 'Kelola Data Kost')

@section('content')

<div class="table-card">
    <div class="table-toolbar">
        <div class="toolbar-left">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchKost" placeholder="Cari nama kost..." onkeyup="filterTable('tableKost', this.value)">
            </div>
            <select class="filter-select" id="filterKategori" onchange="filterBySelect()">
                <option value="">Semua Kategori</option>
                @foreach($kategoris ?? [] as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            <select class="filter-select" id="filterWilayah" onchange="filterBySelect()">
                <option value="">Semua Wilayah</option>
                @foreach($wilayahs ?? [] as $wil)
                    <option value="{{ $wil->id }}">{{ $wil->nama_kecamatan }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('admin.kost.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Kost
        </a>
    </div>

    <table class="admin-table" id="tableKost">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama Kost</th>
                <th>Kecamatan</th>
                <th>Kategori</th>
                <th>Harga/Bulan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kosts ?? [] as $kost)
            <tr data-kategori="{{ $kost->kategori_id }}" data-wilayah="{{ $kost->wilayah_id }}">
                <td>{{ $kost->id }}</td>
                <td>
                    @if($kost->fotos->count())
                        <img src="{{ asset('storage/'.$kost->fotos->first()->foto) }}" class="table-kost-img" alt="foto">
                    @else
                        <div class="no-img"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td><strong>{{ $kost->nama_kost }}</strong></td>
                <td>{{ $kost->wilayah->nama_kecamatan ?? '-' }}</td>
                <td><span class="badge-kategori">{{ $kost->kategori->nama_kategori ?? '-' }}</span></td>
                <td>Rp {{ number_format($kost->harga, 0, ',', '.') }}</td>
                <td>
                    <span class="badge-status {{ $kost->status === 'tersedia' ? 'available' : 'full' }}">
                        {{ ucfirst($kost->status) }}
                    </span>
                </td>
                <td class="action-btns">
                    <a href="{{ route('admin.kost.edit', $kost->id) }}" class="btn-action edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn-action delete" onclick="confirmDelete('{{ route('admin.kost.destroy', $kost->id) }}', 'kost {{ $kost->nama_kost }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="table-empty">Belum ada data kost</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-pagination">
        {{ $kosts->links() ?? '' }}
    </div>
</div>

@endsection

@push('scripts')
<script>
function filterBySelect() {
    const kategoriVal = document.getElementById('filterKategori').value;
    const wilayahVal  = document.getElementById('filterWilayah').value;
    const rows = document.querySelectorAll('#tableKost tbody tr');
    rows.forEach(row => {
        const kat = row.dataset.kategori || '';
        const wil = row.dataset.wilayah  || '';
        const matchKat = !kategoriVal || kat === kategoriVal;
        const matchWil = !wilayahVal  || wil === wilayahVal;
        row.style.display = (matchKat && matchWil) ? '' : 'none';
    });
}
</script>
@endpush