<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\KostFoto;
use App\Models\Kategori;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    public function index()
    {
        $kosts     = Kost::with(['kategori', 'wilayah', 'fotos'])->latest()->paginate(15);
        $kategoris = Kategori::all();
        $wilayahs  = Wilayah::all();
        return view('admin.kost', compact('kosts', 'kategoris', 'wilayahs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $wilayahs  = Wilayah::all();
        return view('admin.kost-form', compact('kategoris', 'wilayahs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kost'   => 'required|max:200',
            'deskripsi'   => 'nullable',
            'alamat'      => 'required',
            'wilayah_id'  => 'required|exists:wilayah,id',
            'kategori_id' => 'required|exists:kategori,id',
            'harga'       => 'required|numeric|min:0',
            'fasilitas'   => 'nullable',
            'no_hp'       => 'required|max:20',
            'maps'        => 'nullable|url',
            'status'      => 'required|in:tersedia,penuh',
            'fotos.*'     => 'nullable|image|max:2048',
        ]);

        // Tambahkan '$kost =' di depannya
        $kost = \App\Models\Kost::create($data);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('kost', 'public');
                KostFoto::create(['kost_id' => $kost->id, 'foto' => $path]);
            }
        }

        return redirect()->route('admin.kost.index')
            ->with('success', 'Kost berhasil ditambahkan.');
    }

    public function edit(Kost $kost)
    {
        $kategoris = Kategori::all();
        $wilayahs  = Wilayah::all();
        return view('admin.kost-form', compact('kost', 'kategoris', 'wilayahs'));
    }

    public function update(Request $request, Kost $kost)
    {
        $data = $request->validate([
            'nama_kost'   => 'required|max:200',
            'deskripsi'   => 'nullable',
            'alamat'      => 'required',
            'wilayah_id'  => 'required|exists:wilayah,id',
            'kategori_id' => 'required|exists:kategori,id',
            'harga'       => 'required|numeric|min:0',
            'fasilitas'   => 'nullable',
            'no_hp'       => 'required|max:20',
            'maps'        => 'nullable|url',
            'status'      => 'required|in:tersedia,penuh',
            'fotos.*'     => 'nullable|image|max:2048',
        ]);

        $kost->update($data);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('kost', 'public');
                KostFoto::create(['kost_id' => $kost->id, 'foto' => $path]);
            }
        }

        return redirect()->route('admin.kost.index')
            ->with('success', 'Kost berhasil diperbarui.');
    }

    public function destroy(Kost $kost)
    {
        // Hapus semua foto terkait
        foreach ($kost->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }
        $kost->delete();
        return back()->with('success', 'Kost berhasil dihapus.');
    }

    public function destroyFoto($id)
    {
        $foto = KostFoto::findOrFail($id);
        Storage::disk('public')->delete($foto->foto);
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}