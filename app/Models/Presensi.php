<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;


class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['tanggal_kehadiran', 'status_kehadiran', 'id_employee'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }

    protected $attributes = [
        'status_kehadiran' => 1, 
    ];

}
