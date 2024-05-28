<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $table = 'penarikan_saldo';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['nominal_penarikan','no_rekening', 'status', 'tanggal_penarikan', 'id_customer'];

    public function customer()
    {
        return $this->belongsTo(Users::class, 'id');
    }
}