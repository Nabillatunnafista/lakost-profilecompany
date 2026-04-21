<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{
    protected $fillable = [
        'user_id', 
        'nama', 
        'no_hp', 
        'alamat', 
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}