<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wilayah;

class WilayahController extends Controller
{
    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {
        $wilayahs = Wilayah::latest()->get();
        return view('admin.wilayah', compact('wilayahs'));
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kecamatan' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
        ]);

        Wilayah::create($data);

        return redirect()->back()->with('success', 'Wilayah berhasil ditambahkan!');
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_kecamatan' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
        ]);

        $wilayah = Wilayah::findOrFail($id);
        $wilayah->update($data);

        return redirect()->back()->with('success', 'Wilayah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $wilayah = Wilayah::findOrFail($id);
        $wilayah->delete();

        return redirect()->back()->with('success', 'Wilayah berhasil dihapus!');
    }
}