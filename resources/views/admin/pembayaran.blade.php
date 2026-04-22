@extends('layouts.admin')

@section('content')

<div class="table-card">

    <div class="table-header">
        <div class="table-title">Kelola Pembayaran</div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Kost</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($pembayarans as $p)
            <tr>
                <td>{{ $p->booking->kost->nama_kost ?? '-' }}</td>

                <td>
                    @if($p->bukti_pembayaran)
                        <img src="{{ asset('storage/'.$p->bukti_pembayaran) }}" width="80" style="border-radius:8px;">
                    @else
                        -
                    @endif
                </td>

                <td>
                    <span class="badge-status {{ $p->status }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>

                <td>
                    <a href="{{ route('admin.pembayaran.update', [$p->id, 'valid']) }}" class="btn-action btn-approve">✔</a>
                    <a href="{{ route('admin.pembayaran.update', [$p->id, 'ditolak']) }}" class="btn-action btn-reject">✖</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Belum ada pembayaran</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection