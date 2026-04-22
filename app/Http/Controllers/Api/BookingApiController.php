<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Booking::with(['user', 'kost'])->get()
        );
    }

    public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'kost_id' => $request->kost_id,
            'tanggal_booking' => now(),
            'status' => 'pending'
        ]);

        return response()->json($booking);
    }
}