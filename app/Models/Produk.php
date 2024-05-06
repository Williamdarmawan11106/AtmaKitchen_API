<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'nama_produk',
        'stok',
        'kuota',
        'harga',
        'kategori',
        'ukuran',
        'packaging',
        'deskripsi',
        'gambar_produk',
        'id_penitip',
        'id_hampers',
    ];

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'id');
    }

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'id');
    }
}