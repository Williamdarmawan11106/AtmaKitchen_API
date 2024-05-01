<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $primaryKey = 'ID_Employee';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Employee', 'Nama_Employee', 'Nomor_Telepon', 'Gaji', 'Bonus', 'ID_Jabatan'];

    public function position()
    {
        return $this->belongsTo(Jabatan::class, 'ID_Jabatan');
    }
}
