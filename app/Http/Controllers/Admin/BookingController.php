<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user','kost'])->latest()->get();
        return view('admin.booking', compact('bookings'));
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = $status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diupdate');
    }
}