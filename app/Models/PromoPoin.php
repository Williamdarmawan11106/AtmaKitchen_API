<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoPoin extends Model
{
    use HasFactory;

    protected $table = 'promo_poin';
    protected $primaryKey = 'ID_PromoPoin';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_PromoPoin', 'Nominal', 'Jumlah_Poin'];
}
