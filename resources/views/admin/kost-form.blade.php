@extends('layouts.admin')

@section('title', isset($kost) ? 'Edit Kost' : 'Tambah Kost')
@section('page_title', isset($kost) ? 'Edit Data Kost' : 'Tambah Data Kost')

@section('content')

<div class="form-page-card">
    <form action="{{ isset($kost) ? route('admin.kost.update', $kost->id) : route('admin.kost.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($kost)) @method('PUT') @endif

        <div class="form-grid-2">
            {{-- Nama Kost --}}
            <div class="form-group full-width">
                <label>Nama Kost <span class="req">*</span></label>
                <input type="text" name="nama_kost" class="form-control"
                    value="{{ old('nama_kost', $kost->nama_kost ?? '') }}" 
                    placeholder="Contoh: Kost Pak Ahmad" required>
                @error('nama_kost') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Kecamatan --}}
            <div class="form-group">
                <label>Kecamatan <span class="req">*</span></label>
                <select name="wilayah_id" class="form-control" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($wilayahs as $wil)
                        <option value="{{ $wil->id }}" {{ old('wilayah_id', $kost->wilayah_id ?? '') == $wil->id ? 'selected' : '' }}>
                            {{ $wil->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
                @error('wilayah_id') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-group">
                <label>Kategori <span class="req">*</span></label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $kost->kategori_id ?? '') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Harga --}}
            <div class="form-group">
                <label>Harga per Bulan (Rp) <span class="req">*</span></label>
                <input type="number" name="harga" class="form-control"
                    value="{{ old('harga', $kost->harga ?? '') }}"
                    placeholder="500000" required>
                @error('harga') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Nomor HP --}}
            <div class="form-group">
                <label>Nomor HP Pemilik <span class="req">*</span></label>
                <input type="text" name="no_hp" class="form-control"
                    value="{{ old('no_hp', $kost->no_hp ?? '') }}"
                    placeholder="08xxxxxxxxxx" required>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status <span class="req">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="tersedia" {{ old('status', $kost->status ?? '') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="penuh"    {{ old('status', $kost->status ?? '') === 'penuh' ? 'selected' : '' }}>Penuh</option>
                </select>
            </div>

            {{-- Alamat --}}
            <div class="form-group full-width">
                <label>Alamat Lengkap <span class="req">*</span></label>
                <textarea name="alamat" class="form-control" rows="2" 
                    placeholder="Jl. ... No. ..." required>{{ old('alamat', $kost->alamat ?? '') }}</textarea>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group full-width">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"
                    placeholder="Deskripsi singkat kost...">{{ old('deskripsi', $kost->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Fasilitas --}}
            <div class="form-group full-width">
                <label>Fasilitas</label>
                <textarea name="fasilitas" class="form-control" rows="2"
                    placeholder="Contoh: WiFi, AC, Kamar Mandi Dalam, ...">{{ old('fasilitas', $kost->fasilitas ?? '') }}</textarea>
            </div>

            {{-- Link Maps --}}
            <div class="form-group full-width">
                <label>Link Google Maps</label>
                <input type="url" name="maps" class="form-control"
                    value="{{ old('maps', $kost->maps ?? '') }}"
                    placeholder="https://maps.google.com/...">
            </div>

            {{-- Upload Foto --}}
            <div class="form-group full-width">
                <label>Foto Kost</label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="fotos[]" id="fotoInput" 
                           accept="image/*" multiple 
                           onchange="previewMultiFoto(this)" style="display:none">
                    <label for="fotoInput" class="upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Klik untuk upload foto</span>
                        <small>JPG, PNG, WEBP — maks 2MB per file</small>
                    </label>
                </div>
                <div class="foto-grid" id="fotoPreviewGrid"></div>

                {{-- Existing fotos --}}
                @if(isset($kost) && $kost->fotos->count())
                <div class="existing-fotos">
                    <p class="label-small">Foto saat ini:</p>
                    <div class="foto-grid">
                        @foreach($kost->fotos as $foto)
                        <div class="foto-item-existing">
                            <img src="{{ asset('storage/'.$foto->foto) }}" alt="foto">
                            <button type="button" class="foto-delete-btn"
                                onclick="confirmDelete('{{ route('admin.kost.foto.destroy', $foto->id) }}', 'foto ini')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.kost.index') }}" class="btn-cancel">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> {{ isset($kost) ? 'Update Kost' : 'Simpan Kost' }}
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
function previewMultiFoto(input) {
    const grid = document.getElementById('fotoPreviewGrid');
    grid.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'foto-item-preview';
            div.innerHTML = `<img src="${e.target.result}" alt="preview">`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush