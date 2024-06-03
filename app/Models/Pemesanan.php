<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = ['no_nota', 'jumlah_pesanan', 'harga_pesanan', 'tanggal_pesanan', 'tanggal_diambil', 'tanggal_pembayaran', 'bukti_pembayaran', 'status_pesanan', 'tip', 'delivery', 'id_promo', 'id_customer', 'id_alamat'];

    public function customer()
    {
        return $this->belongsTo(Users::class, 'id');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id');
    }

    public function promopoin()
    {
        return $this->belongsTo(PromoPoin::class, 'id');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pemesanan');
    }
}