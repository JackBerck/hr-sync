<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Absensi')]
class Show extends Component
{
    public Absensi $absensi;

    public function mount($id)
    {
        $this->absensi = Absensi::with(['pegawai.jabatan', 'pegawai.unitKerja'])->findOrFail($id);
    }

    public function render()
    {
        // Hitung statistik absensi pegawai bulan ini
        $bulanIni = now();
        $statistikBulanIni = [
            'hadir' => Absensi::where('pegawai_id', $this->absensi->pegawai_id)
                ->whereYear('tanggal', $bulanIni->year)
                ->whereMonth('tanggal', $bulanIni->month)
                ->where('status', 'hadir')
                ->count(),
            'alpha' => Absensi::where('pegawai_id', $this->absensi->pegawai_id)
                ->whereYear('tanggal', $bulanIni->year)
                ->whereMonth('tanggal', $bulanIni->month)
                ->where('status', 'alpha')
                ->count(),
            'sakit' => Absensi::where('pegawai_id', $this->absensi->pegawai_id)
                ->whereYear('tanggal', $bulanIni->year)
                ->whereMonth('tanggal', $bulanIni->month)
                ->where('status', 'sakit')
                ->count(),
            'izin' => Absensi::where('pegawai_id', $this->absensi->pegawai_id)
                ->whereYear('tanggal', $bulanIni->year)
                ->whereMonth('tanggal', $bulanIni->month)
                ->where('status', 'izin')
                ->count(),
        ];

        $totalBulanIni = array_sum($statistikBulanIni);

        return view('livewire.absensi.show', compact('statistikBulanIni', 'totalBulanIni'));
    }
}