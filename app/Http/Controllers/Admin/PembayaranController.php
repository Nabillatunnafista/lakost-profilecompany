<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('booking.kost')->latest()->get();
        return view('admin.pembayaran', compact('pembayarans'));
    }

    public function updateStatus($id, $status)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $status;
        $pembayaran->save();

        return back()->with('success', 'Status pembayaran diupdate');
    }

    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return back()->with('success', 'Pembayaran dihapus');
    }
}