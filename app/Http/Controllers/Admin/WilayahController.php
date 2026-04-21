<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use App\Models\Kategori;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayahs = Wilayah::all();
        $kategoris = Kategori::all(); // Diperlukan karena tab-nya digabung
        return view('admin.kategori', compact('wilayahs', 'kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama_kecamatan' => 'required', 'keterangan' => 'nullable']);
        Wilayah::create($data);
        return back()->with('success', 'Wilayah berhasil ditambahkan.');
    }
    public function destroy($id)
{
    $wilayah = \App\Models\Wilayah::findOrFail($id);
    $wilayah->delete();
    return redirect()->back()->with('success', 'Data Wilayah berhasil dihapus!');
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama_kecamatan' => 'required|string|max:150',
        'keterangan' => 'nullable|string',
    ]);

    $wilayah = \App\Models\Wilayah::findOrFail($id);
    $wilayah->update([
        'nama_kecamatan' => $request->nama_kecamatan,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->back()->with('success', 'Data wilayah berhasil diperbarui!');
}
}