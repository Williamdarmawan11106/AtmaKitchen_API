<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';
    protected $primaryKey = 'ID_Alamat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Alamat', 'Nama_Alamat', 'Kode_Pos', 'Jarak_Pengiriman', 'ID_Customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_Customer');
    }

}
