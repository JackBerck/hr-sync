<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Title('Data Absensi')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterPegawai = '';
    public $filterStatus = '';
    public $filterTanggal = '';
    public $filterBulan = '';
    public $showDeleteModal = false;
    public $absensiToDelete = null;

    // New properties for daily attendance
    public $selectedDate;
    public $activeTab = 'list'; // 'list' or 'daily'
    public $dailyAbsensis = [];
    public $showDailyModal = false;

    public function mount()
    {
        $this->filterBulan = now()->format('Y-m');
        $this->selectedDate = today()->format('Y-m-d');
        $this->loadDailyData();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterPegawai()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterTanggal()
    {
        $this->resetPage();
    }

    public function updatingFilterBulan()
    {
        $this->resetPage();
    }

    public function updatedSelectedDate()
    {
        $this->loadDailyData();
    }

    public function loadDailyData()
    {
        // Load semua pegawai aktif
        $pegawais = Pegawai::with(['jabatan', 'unitKerja'])
            ->orderBy('nama')
            ->get();

        // Load absensi yang sudah ada untuk tanggal terpilih
        $existingAbsensis = Absensi::getAbsensiByDate($this->selectedDate);

        // Initialize array absensi
        $this->dailyAbsensis = [];
        foreach ($pegawais as $pegawai) {
            $this->dailyAbsensis[$pegawai->id] = [
                'pegawai' => $pegawai,
                'status' => $existingAbsensis->has($pegawai->id)
                    ? $existingAbsensis[$pegawai->id]->status
                    : '',
                'is_existing' => $existingAbsensis->has($pegawai->id)
            ];
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        if ($tab === 'daily') {
            $this->loadDailyData();
        }
    }

    public function openDailyModal()
    {
        $this->showDailyModal = true;
        $this->loadDailyData();
    }

    public function updateDailyStatus($pegawaiId, $status)
    {
        if (isset($this->dailyAbsensis[$pegawaiId])) {
            $this->dailyAbsensis[$pegawaiId]['status'] = $status;
        }
    }

    public function markAllAs($status)
    {
        foreach ($this->dailyAbsensis as $pegawaiId => $data) {
            $this->dailyAbsensis[$pegawaiId]['status'] = $status;
        }
    }

    public function clearAll()
    {
        foreach ($this->dailyAbsensis as $pegawaiId => $data) {
            $this->dailyAbsensis[$pegawaiId]['status'] = '';
        }
    }

    public function saveDailyAbsensi()
    {
        $date = Carbon::parse($this->selectedDate);
        $savedCount = 0;
        $updatedCount = 0;

        foreach ($this->dailyAbsensis as $pegawaiId => $data) {
            if (empty($data['status'])) {
                continue;
            }

            // Cek apakah sudah ada absensi
            $existingAbsensi = Absensi::where('pegawai_id', $pegawaiId)
                ->whereDate('tanggal', $date)
                ->first();

            if ($existingAbsensi) {
                // Update existing
                $existingAbsensi->update(['status' => $data['status']]);
                $updatedCount++;
            } else {
                // Create new
                Absensi::create([
                    'pegawai_id' => $pegawaiId,
                    'tanggal' => $date,
                    'status' => $data['status'],
                ]);
                $savedCount++;
            }
        }

        $message = "Absensi berhasil disimpan! ";
        if ($savedCount > 0) {
            $message .= "{$savedCount} data baru ditambahkan. ";
        }
        if ($updatedCount > 0) {
            $message .= "{$updatedCount} data diperbarui.";
        }

        session()->flash('message', $message);
        $this->showDailyModal = false;
        $this->loadDailyData();
    }

    public function getDailyStats()
    {
        $stats = [
            'hadir' => 0,
            'alpha' => 0,
            'sakit' => 0,
            'izin' => 0,
            'total' => 0,
            'not_set' => 0
        ];

        foreach ($this->dailyAbsensis as $data) {
            if (!empty($data['status'])) {
                $stats[$data['status']]++;
                $stats['total']++;
            } else {
                $stats['not_set']++;
            }
        }

        return $stats;
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->absensiToDelete = $id;
    }

    public function destroy()
    {
        if ($this->absensiToDelete) {
            $absensi = Absensi::findOrFail($this->absensiToDelete);
            $absensi->delete();

            $this->showDeleteModal = false;
            $this->absensiToDelete = null;

            session()->flash('message', 'Data absensi berhasil dihapus.');
        }
    }

    public function render()
    {
        $absensis = Absensi::with(['pegawai'])
            ->when($this->search, function ($query) {
                $query->whereHas('pegawai', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterPegawai, function ($query) {
                $query->where('pegawai_id', $this->filterPegawai);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterTanggal, function ($query) {
                $query->whereDate('tanggal', $this->filterTanggal);
            })
            ->when($this->filterBulan, function ($query) {
                $query->whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$this->filterBulan]);
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pegawais = Pegawai::orderBy('nama')->get();

        // Statistics
        $stats = [
            'total_hari_ini' => Absensi::whereDate('tanggal', today())->count(),
            'hadir_hari_ini' => Absensi::whereDate('tanggal', today())->where('status', 'hadir')->count(),
            'alpha_hari_ini' => Absensi::whereDate('tanggal', today())->where('status', 'alpha')->count(),
            'total_bulan_ini' => Absensi::whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month)->count(),
        ];

        $dailyStats = $this->getDailyStats();
        $formattedDate = Carbon::parse($this->selectedDate)->translatedFormat('l, d F Y');

        return view('livewire.absensi.index', compact(
            'absensis',
            'pegawais',
            'stats',
            'dailyStats',
            'formattedDate'
        ));
    }
}
