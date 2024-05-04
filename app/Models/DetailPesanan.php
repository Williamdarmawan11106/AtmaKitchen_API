<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'ID_Detail_Pesanan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Detail_Pesanan', 'Jumlah', 'Harga', 'ID_Hampers', 'ID_Produk', 'ID_Pemesanan'];

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'ID_Hampers');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ID_Produk');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'ID_Pemesanan');
    }
}
