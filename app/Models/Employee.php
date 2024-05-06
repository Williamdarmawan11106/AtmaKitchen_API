<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['nama_employee', 'nomor_telepon', 'Gaji', 'Bonus','Password', 'ID_Jabatan'];

    public function position()
    {
        return $this->belongsTo(Jabatan::class, 'ID_Jabatan');
    }
}
