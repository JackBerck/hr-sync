<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_jabatan',
        'tunjangan',
    ];

    protected $casts = [
        'tunjangan' => 'decimal:2'
    ];

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
