<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\BahanBaku;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'reseps';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = ['jumlah_bahan_baku', 'id_produk', 'id_bahan_baku'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }


    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku');
    }

}