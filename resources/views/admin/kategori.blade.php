@extends('layouts.admin')

@section('title', 'Kelola Kategori & Wilayah')
@section('page_title', 'Kelola Kategori & Wilayah')

@section('content')

<div class="tab-nav">
    <button class="tab-btn active" data-tab="kategori">
        <i class="fas fa-tags"></i> Tabel Kategori
    </button>
    <button class="tab-btn" data-tab="wilayah">
        <i class="fas fa-map-marker-alt"></i> Tabel Area/Wilayah
    </button>
</div>

{{-- ─── TAB: KATEGORI ─── --}}
<div class="tab-content active" id="tab-kategori">
    <div class="table-card">
        <div class="table-toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari kategori..." onkeyup="filterTable('tableKategori', this.value)">
            </div>
            <button class="btn-add" onclick="openModal('modalAddKategori')">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
        <table class="admin-table" id="tableKategori">
            <thead>
                <tr><th>ID</th><th>Nama Kategori</th><th>Deskripsi</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($kategoris ?? [] as $kat)
                <tr>
                    <td>{{ $kat->id }}</td>
                    <td><strong>{{ $kat->nama_kategori }}</strong></td>
                    <td>{{ $kat->deskripsi ?? '-' }}</td>
                    <td class="action-btns">
                        <button class="btn-action edit" onclick="openEditKategori({{ $kat->id }}, '{{ $kat->nama_kategori }}', '{{ $kat->deskripsi }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" onclick="confirmDelete('{{ route('admin.kategori.destroy', $kat->id) }}', 'kategori {{ $kat->nama_kategori }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="table-empty">Belum ada data kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ─── TAB: WILAYAH ─── --}}
<div class="tab-content" id="tab-wilayah">
    <div class="table-card">
        <div class="table-toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari wilayah..." onkeyup="filterTable('tableWilayah', this.value)">
            </div>
            <button class="btn-add" onclick="openModal('modalAddWilayah')">
                <i class="fas fa-plus"></i> Tambah Wilayah
            </button>
        </div>
        <table class="admin-table" id="tableWilayah">
            <thead>
                <tr><th>ID</th><th>Nama Kecamatan</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($wilayahs ?? [] as $wil)
                <tr>
                    <td>{{ $wil->id }}</td>
                    <td><strong>{{ $wil->nama_kecamatan }}</strong></td>
                    <td>{{ $wil->keterangan ?? '-' }}</td>
                    <td class="action-btns">
                        <button class="btn-action edit" onclick="openEditWilayah({{ $wil->id }}, '{{ $wil->nama_kecamatan }}', '{{ $wil->keterangan }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" onclick="confirmDelete('{{ route('admin.wilayah.destroy', $wil->id) }}', 'wilayah {{ $wil->nama_kecamatan }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="table-empty">Belum ada data wilayah</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL: Tambah Kategori --}}
<div class="modal-overlay" id="modalAddKategori">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-plus-circle"></i> Tambah Kategori</h3>
            <button class="modal-close" onclick="closeModal('modalAddKategori')"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kategori <span class="req">*</span></label>
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Putra" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="2" placeholder="Deskripsi singkat..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalAddKategori')">Batal</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: Edit Kategori --}}
<div class="modal-overlay" id="modalEditKategori">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Kategori</h3>
            <button class="modal-close" onclick="closeModal('modalEditKategori')"><i class="fas fa-times"></i></button>
        </div>
        <form id="formEditKategori" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kategori <span class="req">*</span></label>
                    <input type="text" name="nama_kategori" id="editNamaKategori" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="editDeskripsiKategori" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEditKategori')">Batal</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: Tambah Wilayah --}}
<div class="modal-overlay" id="modalAddWilayah">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-plus-circle"></i> Tambah Wilayah</h3>
            <button class="modal-close" onclick="closeModal('modalAddWilayah')"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('admin.wilayah.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kecamatan <span class="req">*</span></label>
                    <input type="text" name="nama_kecamatan" class="form-control" placeholder="Contoh: Babat" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Keterangan wilayah..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalAddWilayah')">Batal</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: Edit Wilayah --}}
<div class="modal-overlay" id="modalEditWilayah">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Wilayah</h3>
            <button class="modal-close" onclick="closeModal('modalEditWilayah')"><i class="fas fa-times"></i></button>
        </div>
        <form id="formEditWilayah" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kecamatan <span class="req">*</span></label>
                    <input type="text" name="nama_kecamatan" id="editNamaWilayah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" id="editKeteranganWilayah" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEditWilayah')">Batal</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEditKategori(id, nama, deskripsi) {
    document.getElementById('editNamaKategori').value = nama;
    document.getElementById('editDeskripsiKategori').value = deskripsi || '';
    document.getElementById('formEditKategori').action = '/admin/kategori/' + id;
    openModal('modalEditKategori');
}
function openEditWilayah(id, nama, keterangan) {
    document.getElementById('editNamaWilayah').value = nama;
    document.getElementById('editKeteranganWilayah').value = keterangan || '';
    document.getElementById('formEditWilayah').action = '/admin/wilayah/' + id;
    openModal('modalEditWilayah');
}
</script>
@endpush