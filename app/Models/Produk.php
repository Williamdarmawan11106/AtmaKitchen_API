<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'ID_Produk';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'ID_Produk',
        'Nama_Produk',
        'Stok_Produk',
        'Harga_Produk',
        'Gambar_Produk',
        'Deskripsi_Produk',
        'Status_Produk',
        'Kategori_Produk',
        'Ukuran_Produk',
        'Kuota_Produk',
        'ID_Packaging',
        'ID_Penitip',
        'ID_Hampers',
    ];

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'ID_Packaging');
    }

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'ID_Penitip');
    }

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'ID_Hampers');
    }
}