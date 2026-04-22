<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kost_id',
        'tanggal_booking',
        'status'
    ];

    // relasi ke user
    public function user(){
    return $this->belongsTo(User::class);
    }

    // relasi ke kost
    public function kost(){
    return $this->belongsTo(Kost::class);
    }

    // relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}