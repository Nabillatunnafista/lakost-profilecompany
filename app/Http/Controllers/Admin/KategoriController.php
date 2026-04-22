<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // ✅ TAMPIL DATA
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('admin.kategori', compact('kategoris'));
    }

    // ✅ SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        Kategori::create($request->all());

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    // 🔥 WAJIB ADA (INI YANG ERROR KAMU)
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}