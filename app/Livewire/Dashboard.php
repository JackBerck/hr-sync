<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $selectedMonth;
    public $selectedYear;

    public function mount()
    {
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;
    }

    public function updatedSelectedMonth()
    {
        // Data akan refresh otomatis
    }

    public function updatedSelectedYear()
    {
        // Data akan refresh otomatis
    }

    public function getMonthName()
    {
        return Carbon::create($this->selectedYear, $this->selectedMonth, 1)->locale('id')->translatedFormat('F');
    }

    public function render()
    {
        // Basic counts
        $totalPegawai = Pegawai::count();
        $totalJabatan = Jabatan::count();
        $totalUnitKerja = UnitKerja::count();

        // Absensi hari ini
        $absensiHariIni = [
            'hadir' => Absensi::whereDate('tanggal', today())->where('status', 'hadir')->count(),
            'alpha' => Absensi::whereDate('tanggal', today())->where('status', 'alpha')->count(),
            'sakit' => Absensi::whereDate('tanggal', today())->where('status', 'sakit')->count(),
            'izin' => Absensi::whereDate('tanggal', today())->where('status', 'izin')->count(),
        ];
        $totalAbsensiHariIni = array_sum($absensiHariIni);

        // Absensi bulan terpilih
        $absensiBulanIni = [
            'hadir' => Absensi::whereYear('tanggal', $this->selectedYear)
                ->whereMonth('tanggal', $this->selectedMonth)
                ->where('status', 'hadir')->count(),
            'alpha' => Absensi::whereYear('tanggal', $this->selectedYear)
                ->whereMonth('tanggal', $this->selectedMonth)
                ->where('status', 'alpha')->count(),
            'sakit' => Absensi::whereYear('tanggal', $this->selectedYear)
                ->whereMonth('tanggal', $this->selectedMonth)
                ->where('status', 'sakit')->count(),
            'izin' => Absensi::whereYear('tanggal', $this->selectedYear)
                ->whereMonth('tanggal', $this->selectedMonth)
                ->where('status', 'izin')->count(),
        ];
        $totalAbsensiBulanIni = array_sum($absensiBulanIni);

        // Cuti bulan ini
        $cutiBulanIni = Cuti::whereYear('tanggal_mulai', $this->selectedYear)
            ->whereMonth('tanggal_mulai', $this->selectedMonth)
            ->count();

        // Cuti yang sedang berlangsung
        $cutiAktif = Cuti::where('tanggal_mulai', '<=', today())
            ->where('tanggal_akhir', '>=', today())
            ->count();

        // Top 5 pegawai dengan absensi terbanyak bulan ini
        $topPegawaiAbsensi = Pegawai::withCount(['absensis' => function ($query) {
            $query->whereYear('tanggal', $this->selectedYear)
                ->whereMonth('tanggal', $this->selectedMonth);
        }])
            ->having('absensis_count', '>', 0)
            ->orderByDesc('absensis_count')
            ->take(5)
            ->get();

        // Statistik absensi per tanggal (7 hari terakhir)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartData[] = [
                'date' => $date->format('d M'),
                'hadir' => Absensi::whereDate('tanggal', $date)->where('status', 'hadir')->count(),
                'alpha' => Absensi::whereDate('tanggal', $date)->where('status', 'alpha')->count(),
                'sakit' => Absensi::whereDate('tanggal', $date)->where('status', 'sakit')->count(),
                'izin' => Absensi::whereDate('tanggal', $date)->where('status', 'izin')->count(),
            ];
        }

        // Recent activities (5 terbaru)
        $recentAbsensi = Absensi::with('pegawai')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentCuti = Cuti::with('pegawai')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Nama bulan untuk ditampilkan
        $monthName = $this->getMonthName();

        return view('livewire.dashboard', compact(
            'totalPegawai',
            'totalJabatan',
            'totalUnitKerja',
            'absensiHariIni',
            'totalAbsensiHariIni',
            'absensiBulanIni',
            'totalAbsensiBulanIni',
            'cutiBulanIni',
            'cutiAktif',
            'topPegawaiAbsensi',
            'chartData',
            'recentAbsensi',
            'recentCuti',
            'monthName'
        ));
    }
}
