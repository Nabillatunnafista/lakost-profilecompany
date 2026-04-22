<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_id',
        'bukti_pembayaran',
        'status'
    ];

    // relasi ke booking
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}