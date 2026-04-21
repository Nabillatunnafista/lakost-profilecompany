@extends('layouts.admin')

@section('page_title', 'Kelola Users & Profil')

@section('content')
{{-- Tab Navigation --}}
<div class="tab-nav">
    <button class="tab-btn active" data-tab="users">
        <i class="fas fa-user-shield"></i> Tabel Akun Users
    </button>
    <button class="tab-btn" data-tab="profiles">
        <i class="fas fa-id-card"></i> Tabel Profil
    </button>
</div>

{{-- TAB: USERS --}}
<div class="tab-content active" id="tab-users">
    <div class="table-card">
        <div class="table-toolbar">
            <button class="btn-add" onclick="openModal('modalAddUser')">
                <i class="fas fa-plus"></i> Tambah Akun
            </button>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge">{{ $user->role }}</span></td>
                    <td>
                        <button class="btn-action delete" onclick="confirmDelete('{{ route('admin.users.destroy', $user->id) }}', 'User')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- TAB: PROFILES --}}
<div class="tab-content" id="tab-profiles">
    <div class="table-card">
        <div class="table-toolbar">
            <button class="btn-add" onclick="openModal('modalAddProfile')">
                <i class="fas fa-plus"></i> Tambah Profil
            </button>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profiles ?? [] as $profile)
                <tr>
                    <td>
                        @if($profile->foto)
                            <img src="{{ asset('storage/'.$profile->foto) }}" width="40" height="40" style="border-radius: 50%; object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle fa-2x"></i>
                        @endif
                    </td>
                    <td>{{ $profile->nama }}</td>
                    <td>{{ $profile->no_hp }}</td>
                    <td>{{ $profile->user->username ?? '-' }}</td>
                    <td>
                        <button class="btn-action delete" onclick="confirmDelete('{{ route('admin.profiles.destroy', $profile->id) }}', 'Profil')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL: TAMBAH USER --}}
<div class="modal-overlay" id="modalAddUser">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Tambah Akun</h3>
            <button class="modal-close" onclick="closeModal('modalAddUser')">&times;</button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save" style="background: #052659; color: white; padding: 10px 20px; border-radius: 8px; border:none; cursor:pointer;">Simpan User</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: TAMBAH PROFIL --}}
<div class="modal-overlay" id="modalAddProfile">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Tambah Profil</h3>
            <button class="modal-close" onclick="closeModal('modalAddProfile')">&times;</button>
        </div>
        <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Akun User</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->username }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save" style="background: #052659; color: white; padding: 10px 20px; border-radius: 8px; border:none; cursor:pointer;">Simpan Profil</button>
            </div>
        </form>
    </div>
</div>
@endsection