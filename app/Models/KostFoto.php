<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class KostFoto extends Model {
     protected $table = 'kost_foto';
     protected $fillable = ['kost_id', 'foto'];
     public function kost() { return $this->belongsTo(Kost::class); }
}