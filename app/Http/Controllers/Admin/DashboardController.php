<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kost;
use App\Models\Kategori;
use App\Models\Wilayah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers    = User::count();
        $totalKost     = Kost::count();
        $totalKategori = Kategori::count();
        $totalWilayah  = Wilayah::count();

        // Kost by kategori name
        $kostPutra  = Kost::whereHas('kategori', fn($q) => $q->where('nama_kategori', 'Putra'))->count();
        $kostPutri  = Kost::whereHas('kategori', fn($q) => $q->where('nama_kategori', 'Putri'))->count();
        $kostCampur = Kost::whereHas('kategori', fn($q) => $q->where('nama_kategori', 'Campur'))->count();

        $recentKost = Kost::with(['kategori', 'wilayah'])->latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalKost', 'totalKategori', 'totalWilayah',
            'kostPutra', 'kostPutri', 'kostCampur', 'recentKost'
        ));
    }
}