<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Simpan ke database
        Contact::create($request->all());

        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}