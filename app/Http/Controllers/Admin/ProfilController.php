<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // 1. Halaman profil admin (diri sendiri)
    public function adminProfil()
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('admin.profil', compact('user', 'profile'));
    }

    // 2. Update profil admin (diri sendiri)
    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();

        $request->validate([
            'nama' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        $user->update(['email' => $request->email]);

        $profileData = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('foto')) {
            if ($profile && $profile->foto) {
                Storage::disk('public')->delete($profile->foto);
            }
            $profileData['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        Profile::updateOrCreate(['user_id' => $user->id], $profileData);
        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }

    // 3. Simpan Profil Baru User Lain
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id',
            'nama'    => 'required|string|max:255',
            'no_hp'   => 'required|max:20',
            'alamat'  => 'required',
            'foto'    => 'nullable|image|max:2048',
        ], [
            'user_id.unique' => 'User ini sudah memiliki data profil!'
        ]);

        $data = $request->only(['user_id', 'nama', 'no_hp', 'alamat']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        Profile::create($data);
        return back()->with('success', 'Profil user berhasil ditambahkan.');
    }

    // 4. Update Profil User Lain
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'no_hp'   => 'required|max:20',
            'alamat'  => 'required',
            'foto'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'no_hp', 'alamat']);

        if ($request->hasFile('foto')) {
            if ($profile->foto) {
                Storage::disk('public')->delete($profile->foto);
            }
            $data['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        $profile->update($data);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // 5. Hapus Profil
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        if ($profile->foto) {
            Storage::disk('public')->delete($profile->foto);
        }
        $profile->delete();
        return back()->with('success', 'Profil berhasil dihapus.');
    }
}