<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    protected $table = 'positions';
    protected $primaryKey = 'ID_Jabatan';
    protected $fillable = ['Nama_Jabatan'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'ID_Jabatan');
    }
}
