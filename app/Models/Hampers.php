<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;

    protected $table = 'hampers';
    protected $primaryKey = 'ID_Hampers';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Hampers', 'Nama_Hampers', 'Harga_Hampers', 'Deskripsi_Hampers', 'ID_Packaging'];

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'ID_Packaging');
    }
}
