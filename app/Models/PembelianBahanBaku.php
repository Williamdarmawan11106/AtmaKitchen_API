<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BahanBaku;

class PembelianBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pembelian_bahan_bakus';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = ['jumlah_bahan_baku', 'harga_bahan_baku', 'tanggal_pembelian', 'nota_pembelian', 'id_bahan_baku'];

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku');
    }
}
