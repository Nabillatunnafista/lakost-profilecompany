<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Pembayaran::with('booking')->get()
        );
    }

    public function store(Request $request)
    {
        $pembayaran = Pembayaran::create([
            'booking_id' => $request->booking_id,
            'bukti_pembayaran' => $request->bukti_pembayaran,
            'status' => 'menunggu'
        ]);

        return response()->json($pembayaran);
    }
}