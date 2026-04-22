@extends('layouts.admin')

@section('content')

<div class="table-card">

    <div class="table-header">
        <div class="table-title">Kelola Booking</div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Kost</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($bookings as $b)
            <tr>
                <td>{{ $b->user->username ?? '-' }}</td>
                <td>{{ $b->kost->nama_kost ?? '-' }}</td>
                <td>{{ $b->tanggal_booking }}</td>

                <td>
                    <span class="badge-status {{ $b->status }}">
                        {{ ucfirst($b->status) }}
                    </span>
                </td>

                <td>
                    <a href="{{ route('admin.booking.update', [$b->id, 'disetujui']) }}" class="btn-action btn-approve">✔</a>
                    <a href="{{ route('admin.booking.update', [$b->id, 'ditolak']) }}" class="btn-action btn-reject">✖</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="table-empty">Belum ada data booking</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection