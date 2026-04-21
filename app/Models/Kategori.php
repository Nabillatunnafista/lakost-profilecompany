<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model {
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'deskripsi'];
    public function kosts() { return $this->hasMany(Kost::class, 'kategori_id'); }
}