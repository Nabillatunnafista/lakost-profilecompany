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
                <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="fas fa-users"></i><span>Kelola Users</span></a></li>
                <li><a href="{{ route('admin.kategori.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}"><i class="fas fa-tags"></i><span>Kelola Kategori</span></a></li>
                <li><a href="{{ route('admin.wilayah.index') }}" class="sidebar-link {{ request()->routeIs('admin.wilayah*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i><span>Kelola Wilayah</span></a></li>
            </ul>

            <div class="nav-section-label" style="margin-top:24px">Akun</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.profil') }}" class="sidebar-link"><i class="fas fa-user-circle"></i><span>Profil Admin</span></a></li>
                <li>
                    <a href="javascript:void(0)" onclick="confirmLogout()" class="sidebar-link sidebar-logout"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form>
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
</body>
</html>