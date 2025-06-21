<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    // Method untuk mengecek apakah absensi sudah ada
    public static function hasAbsensiForDate($pegawaiId, $tanggal)
    {
        return self::where('pegawai_id', $pegawaiId)
            ->whereDate('tanggal', $tanggal)
            ->exists();
    }

    // Method untuk mendapatkan absensi per tanggal
    public static function getAbsensiByDate($tanggal)
    {
        return self::where('tanggal', $tanggal)
            ->with('pegawai')
            ->get()
            ->keyBy('pegawai_id');
    }

    // Method untuk mendapatkan statistik absensi per tanggal
    public static function getStatsByDate($tanggal)
    {
        $absensis = self::whereDate('tanggal', $tanggal)->get();

        return [
            'hadir' => $absensis->where('status', 'hadir')->count(),
            'alpha' => $absensis->where('status', 'alpha')->count(),
            'sakit' => $absensis->where('status', 'sakit')->count(),
            'izin' => $absensis->where('status', 'izin')->count(),
            'total' => $absensis->count(),
        ];
    }

    // Method untuk batch create/update absensi
    public static function saveBulkAbsensi($date, $absensis)
    {
        $savedCount = 0;
        $updatedCount = 0;

        foreach ($absensis as $pegawaiId => $status) {
            if (empty($status)) continue;

            $existing = self::where('pegawai_id', $pegawaiId)
                ->whereDate('tanggal', $date)
                ->first();

            if ($existing) {
                $existing->update(['status' => $status]);
                $updatedCount++;
            } else {
                self::create([
                    'pegawai_id' => $pegawaiId,
                    'tanggal' => $date,
                    'status' => $status,
                ]);
                $savedCount++;
            }
        }

        return compact('savedCount', 'updatedCount');
    }

    // Scope untuk filter bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month);
    }

    // Scope untuk filter hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', today());
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Method untuk mendapatkan warna badge berdasarkan status
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'hadir' => 'green',
            'alpha' => 'red',
            'sakit' => 'yellow',
            'izin' => 'blue',
            default => 'gray'
        };
    }

    // Method untuk mendapatkan icon berdasarkan status
    public function getStatusIconAttribute()
    {
        return match ($this->status) {
            'hadir' => 'check-circle',
            'alpha' => 'x-mark',
            'sakit' => 'beaker',
            'izin' => 'information-circle',
            default => 'question-mark-circle'
        };
    }
}
