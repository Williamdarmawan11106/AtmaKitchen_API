<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'ID_Pemesanan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Pemesanan', 'Jumlah_Pesanan', 'Harga_Pesanan', 'Tanggal_Pesanan', 'Tanggal_Diambil', 'Tanggal_Pembayaran', 'Bukti_Pembayaran', 'Status_Pemesanan', 'Akumulasi_PromoPoin', 'ID_Customer', 'ID_Alamat', 'ID_PromoPoin', 'ID_Detail_Pesanan', 'Pengiriman', 'Tip'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_Customer');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'ID_Alamat');
    }

    public function promopoin()
    {
        return $this->belongsTo(PromoPoin::class, 'ID_PromoPoin');
    }

    public function detailpesanan()
    {
        return $this->belongsTo(DetailPesanan::class, 'ID_Detail_Pesanan');
    }
}