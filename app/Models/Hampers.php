<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;

    protected $table = 'hampers';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['nama_hampers', 'harga_hampers', 'packaging_hampers'];

    public function detailHampers()
    {
        return $this->hasMany(DetailHampers::class, 'id_hampers');
    }
}
