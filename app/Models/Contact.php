<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Daftarkan kolom yang ada di migrasi kamu di sini
    protected $fillable = [
        'name', 
        'email', 
        'message',
    ];
}