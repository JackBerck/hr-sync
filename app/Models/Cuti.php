<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Cuti extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'pegawai_id',
        'tanggal_mulai',
        'tanggal_akhir',
        'alasan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    // Method untuk menghitung jumlah hari cuti (accessor)
    public function getJumlahHariAttribute()
    {
        return $this->tanggal_mulai->diffInDays($this->tanggal_akhir) + 1;
    }

    // Method static untuk mengecek cuti tahun ini untuk pegawai tertentu
    public static function getTotalCutiTahunIni($pegawaiId, $tahun = null)
    {
        $tahun = $tahun ?? now()->year;
        
        return self::where('pegawai_id', $pegawaiId)
            ->whereYear('tanggal_mulai', $tahun)
            ->get()
            ->sum(function ($cuti) {
                return $cuti->tanggal_mulai->diffInDays($cuti->tanggal_akhir) + 1;
            });
    }

    // Method static untuk mengecek sisa cuti
    public static function getSisaCuti($pegawaiId, $tahun = null)
    {
        $totalCuti = self::getTotalCutiTahunIni($pegawaiId, $tahun);
        return 12 - $totalCuti;
    }
}