<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;

    protected $table = 'penitip';
    // protected $primaryKey = 'ID_Penitip';
    protected $fillable = [
        'Nama_Penitip',
    ];
}