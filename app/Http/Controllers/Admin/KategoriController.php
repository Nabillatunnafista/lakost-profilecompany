<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama_kategori' => 'required', 'deskripsi' => 'nullable']);
        Kategori::create($data);
        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:100',
    ]);

    $kategori = \App\Models\Kategori::findOrFail($id);

    $kategori->update([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
}
}