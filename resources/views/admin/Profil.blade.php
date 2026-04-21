@extends('layouts.admin')

@section('content')
<div class="table-card" style="padding: 20px;">
    <h3>Profil Admin</h3>
    <hr>
    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $profile->nama ?? '' }}">
        </div>

        <div class="form-group">
            <label>Foto Profil</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn-save" style="margin-top: 20px;">Update Profil</button>
    </form>
</div>
@endsection