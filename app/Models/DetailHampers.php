<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHampers extends Model
{
    use HasFactory;

    protected $table = 'detail_hampers';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';  
    public $timestamps = true; 
    protected $fillable = ['jumlah', 'id_produk', 'id_hampers'];

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'id_hampers');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
