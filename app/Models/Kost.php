<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model {
    protected $table = 'kost';
    protected $fillable = [
    'nama_kost', 
    'deskripsi', 
    'alamat', 
    'wilayah_id', 
    'kategori_id', 
    'harga', 
    'fasilitas', 
    'no_hp',     
    'maps',     
    'status'     
];
    public function kategori(){
    return $this->belongsTo(Kategori::class);
    }
    public function wilayah(){
    return $this->belongsTo(Wilayah::class);
    }
    public function fotos() { return $this->hasMany(KostFoto::class); }
}