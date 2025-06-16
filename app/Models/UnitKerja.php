<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitKerja extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nama_unit',
        'lokasi',
    ];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
