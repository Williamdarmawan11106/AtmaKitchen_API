<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamats';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['alamat', 'nama_penerima', 'no_telpon', 'catatan', 'id_customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

}
