@extends('layouts.admin')

@section('title', 'Kelola Wilayah')
@section('page_title', 'Kelola Wilayah')

@section('content')

<div class="table-card">

    <div class="table-header">
        <div class="table-title">Daftar Wilayah</div>

        <button class="btn-add" onclick="openModal('modalAddWilayah')">
            <i class="fas fa-plus"></i> Tambah Wilayah
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:60px;">No</th>
                <th>Nama Kecamatan</th>
                <th>Keterangan</th>
                <th style="width:120px; text-align:right;">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($wilayahs as $index => $wil)
        <tr>
            <td>{{ $index + 1 }}</td>

            <td><strong>{{ $wil->nama_kecamatan }}</strong></td>

            <td>{{ $wil->keterangan ?? '-' }}</td>

            <td>
                <div class="action-group">
                    <div class="btn-icon btn-edit"
                        onclick="openEditWilayah({{ $wil->id }}, '{{ $wil->nama_kecamatan }}', '{{ $wil->keterangan }}')">
                        <i class="fas fa-pen"></i>
                    </div>

                    <div class="btn-icon btn-delete"
                        onclick="confirmDelete('{{ route('admin.wilayah.destroy',$wil->id) }}')">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="table-empty">Belum ada wilayah</td>
        </tr>
        @endforelse
        </tbody>
    </table>

        {{-- MODAL TAMBAH --}}
    <div class="modal-overlay" id="modalAddWilayah">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Tambah Wilayah</h3>
                <button class="modal-close" onclick="closeModal('modalAddWilayah')">×</button>
            </div>

            <form action="{{ route('admin.wilayah.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nama_kecamatan" class="form-control" placeholder="Nama kecamatan" required>
                </div>

                <div class="form-group">
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalAddWilayah')">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal-overlay" id="modalEditWilayah">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Edit Wilayah</h3>
                <button class="modal-close" onclick="closeModal('modalEditWilayah')">×</button>
            </div>

            <form id="formEditWilayah" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <input type="text" id="editNamaWilayah" name="nama_kecamatan" class="form-control" required>
                </div>

                <div class="form-group">
                    <textarea id="editKeteranganWilayah" name="keterangan" class="form-control"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalEditWilayah')">Batal</button>
                    <button type="submit" class="btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>
   <form action="{{ route('admin.wilayah.destroy', $wil->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
    </form>
</div>

@endsection