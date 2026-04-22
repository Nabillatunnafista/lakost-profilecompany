<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – LAkost Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<div class="admin-wrapper">
    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-text">
                <span>LA<strong>kost</strong></span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i><span>Kelola Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i><span>Kelola Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.wilayah.index') }}" class="sidebar-link {{ request()->routeIs('admin.wilayah*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt"></i><span>Kelola Wilayah</span>
                    </a>
                </li>

                {{-- Fitur Transaksi LAkost --}}
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="sidebar-link {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Kelola Booking</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pembayaran.index') }}" class="sidebar-link {{ request()->routeIs('admin.pembayaran*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Kelola Pembayaran</span>
                    </a>
                </li>
            </ul>

            <div class="nav-section-label" style="margin-top:24px">Akun</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.profil') }}" class="sidebar-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i><span>Profil Admin</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="confirmLogout()" class="sidebar-link sidebar-logout">
                        <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <main class="admin-main" id="adminMain">
        <header class="topbar">
            <div class="topbar-left">
                <div class="topbar-title"><h2>@yield('page_title', 'Dashboard')</h2></div>
            </div>
            <div class="topbar-right">
                <div class="topbar-admin">
                    <strong>{{ auth()->user()->username }}</strong>
                    <div class="admin-avatar"><i class="fas fa-user"></i></div>
                </div>
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert-admin alert-success-admin">{{ session('success') }}</div>
            @endif
            
            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout?',
            text: "Apakah anda yakin ingin keluar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }

    function openModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    /* EDIT KATEGORI */
    function openEditKategori(id, nama, deskripsi) {
        document.getElementById('editNamaKategori').value = nama;
        document.getElementById('editDeskripsiKategori').value = deskripsi ?? '';
        document.getElementById('formEditKategori').action = '/admin/kategori/' + id;
        openModal('modalEditKategori');
    }

    /* EDIT WILAYAH */
    function openEditWilayah(id, nama, keterangan) {
        document.getElementById('editNamaWilayah').value = nama;
        document.getElementById('editKeteranganWilayah').value = keterangan ?? '';
        document.getElementById('formEditWilayah').action = '/admin/wilayah/' + id;
        openModal('modalEditWilayah');
    }
    src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    function confirmDelete(url, nama = 'data ini') {
        Swal.fire({
            title: 'Yakin ingin hapus?',
            text: "Data " + nama + " akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                // buat form otomatis
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                let csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                let method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(csrf);
                form.appendChild(method);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

</body>
</html>