<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $primaryKey = 'ID_Presensi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ID_Presensi', 'Tanggal_Kehadiran', 'Status_Kehadiran', 'ID_Employee'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'ID_Employee');
    }

    public function presensis()
    {
        return $this->hasMany(Employee::class, 'ID_Presensi');
    }
}
