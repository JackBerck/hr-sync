<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nip',
        'nama',
        'jabatan_id',
        'unit_kerja_id',
        'gaji'
    ];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function cutis(): HasMany
    {
        return $this->hasMany(Cuti::class);
    }

    public function absensiToday()
    {
        return $this->absensis()->whereDate('tanggal', today())->first();
    }

    public function hasAbsensiToday()
    {
        return $this->absensis()->whereDate('tanggal', today())->exists();
    }

    public function absensiByDate($date)
    {
        return $this->absensis()->whereDate('tanggal', $date)->first();
    }

    // Method untuk mendapatkan statistik absensi bulan ini
    public function getMonthlyStats($month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        $absensis = $this->absensis()
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get();

        return [
            'hadir' => $absensis->where('status', 'hadir')->count(),
            'alpha' => $absensis->where('status', 'alpha')->count(),
            'sakit' => $absensis->where('status', 'sakit')->count(),
            'izin' => $absensis->where('status', 'izin')->count(),
            'total' => $absensis->count(),
        ];
    }

    // Method untuk mendapatkan persentase kehadiran
    public function getAttendancePercentage($month = null, $year = null)
    {
        $stats = $this->getMonthlyStats($month, $year);

        if ($stats['total'] == 0) {
            return 0;
        }

        return round(($stats['hadir'] / $stats['total']) * 100, 2);
    }

    // Method untuk mendapatkan initials nama
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return substr($initials, 0, 2);
    }
}
