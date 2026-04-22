@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kelola Kategori')

@section('content')

<div class="table-card">

    <div class="table-header">
        <div class="table-title">Daftar Kategori</div>

        <button class="btn-add" onclick="openModal('modalAddKategori')">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:60px;">No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th style="width:120px; text-align:right;">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($kategoris as $index => $kat)
        <tr>
            <td>{{ $index + 1 }}</td>

            <td><strong>{{ $kat->nama_kategori }}</strong></td>

            <td>{{ $kat->deskripsi ?? '-' }}</td>

            <td>
                <div class="action-group">
                    <div class="btn-icon btn-edit"
                        onclick="openEditKategori({{ $kat->id }}, '{{ $kat->nama_kategori }}', '{{ $kat->deskripsi }}')">
                        <i class="fas fa-pen"></i>
                    </div>

                    <div class="btn-icon btn-delete"
                        onclick="confirmDelete('{{ route('admin.kategori.destroy',$kat->id) }}')">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="table-empty">Belum ada kategori</td>
        </tr>
        @endforelse
        </tbody>
    </table>
    
        {{-- MODAL TAMBAH --}}
    <div class="modal-overlay" id="modalAddKategori">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Tambah Kategori</h3>
                <button class="modal-close" onclick="closeModal('modalAddKategori')">×</button>
            </div>

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori" required>
                </div>

                <div class="form-group">
                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalAddKategori')">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal-overlay" id="modalEditKategori">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Edit Kategori</h3>
                <button class="modal-close" onclick="closeModal('modalEditKategori')">×</button>
            </div>

            <form id="formEditKategori" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <input type="text" id="editNamaKategori" name="nama_kategori" class="form-control" required>
                </div>

                <div class="form-group">
                    <textarea id="editDeskripsiKategori" name="deskripsi" class="form-control"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalEditKategori')">Batal</button>
                    <button type="submit" class="btn-save">Update</button>
                </div>
                <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action delete">🗑</button>
                    onclick="return confirm('Yakin mau hapus?')"
                </form>
            </form>
        </div>
    </div>

</div>

@endsection