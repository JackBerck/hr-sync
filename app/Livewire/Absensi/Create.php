<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Title('Absensi Harian')]
class Create extends Component
{
    public $selectedDate;
    public $absensis = [];
    public $pegawais;
    public $formattedDate;
    public $stats = [
        'hadir' => 0,
        'alpha' => 0,
        'sakit' => 0,
        'izin' => 0,
        'total' => 0
    ];

    public function mount()
    {
        $this->selectedDate = today()->format('Y-m-d');
        $this->loadPegawais();
        $this->loadExistingAbsensis();
        $this->updateFormattedDate();
    }

    public function updatedSelectedDate()
    {
        $this->loadExistingAbsensis();
        $this->updateFormattedDate();
        $this->calculateStats();
    }

    public function updatedAbsensis()
    {
        $this->calculateStats();
    }

    private function loadPegawais()
    {
        $this->pegawais = Pegawai::with(['jabatan', 'unitKerja'])
            ->orderBy('nama')
            ->get();
    }

    private function loadExistingAbsensis()
    {
        // Reset absensis array
        $this->absensis = [];

        // Load existing absensis for selected date
        $existingAbsensis = Absensi::getAbsensiByDate($this->selectedDate);

        // Initialize absensis array with existing data
        foreach ($this->pegawais as $pegawai) {
            $this->absensis[$pegawai->id] = $existingAbsensis->has($pegawai->id)
                ? $existingAbsensis[$pegawai->id]->status
                : '';
        }

        $this->calculateStats();
    }

    private function updateFormattedDate()
    {
        $this->formattedDate = Carbon::parse($this->selectedDate)->locale('id')->translatedFormat('l, d F Y');
    }

    private function calculateStats()
    {
        $this->stats = [
            'hadir' => 0,
            'alpha' => 0,
            'sakit' => 0,
            'izin' => 0,
            'total' => 0
        ];

        foreach ($this->absensis as $status) {
            if (!empty($status)) {
                $this->stats[$status]++;
                $this->stats['total']++;
            }
        }
    }

    public function markAllAs($status)
    {
        foreach ($this->pegawais as $pegawai) {
            $this->absensis[$pegawai->id] = $status;
        }
        $this->calculateStats();

        session()->flash('message', "Semua pegawai berhasil ditandai sebagai {$status}.");
    }

    public function clearAll()
    {
        foreach ($this->pegawais as $pegawai) {
            $this->absensis[$pegawai->id] = '';
        }
        $this->calculateStats();

        session()->flash('message', 'Semua status absensi berhasil dibersihkan.');
    }

    public function saveAbsensi()
    {
        try {
            $date = Carbon::parse($this->selectedDate);
            $savedCount = 0;
            $updatedCount = 0;
            $errors = [];

            // Validate date is not in the future
            if ($date->isFuture()) {
                session()->flash('error', 'Tidak dapat menyimpan absensi untuk tanggal yang akan datang.');
                return;
            }

            foreach ($this->absensis as $pegawaiId => $status) {
                if (empty($status)) {
                    continue;
                }

                // Validate status
                if (!in_array($status, ['hadir', 'alpha', 'sakit', 'izin'])) {
                    $errors[] = "Status tidak valid untuk pegawai ID: {$pegawaiId}";
                    continue;
                }

                // Check if absensi already exists
                $existingAbsensi = Absensi::where('pegawai_id', $pegawaiId)
                    ->whereDate('tanggal', $date)
                    ->first();

                if ($existingAbsensi) {
                    // Update existing
                    $existingAbsensi->update(['status' => $status]);
                    $updatedCount++;
                } else {
                    // Create new
                    Absensi::create([
                        'pegawai_id' => $pegawaiId,
                        'tanggal' => $date,
                        'status' => $status,
                    ]);
                    $savedCount++;
                }
            }

            if (!empty($errors)) {
                session()->flash('error', 'Beberapa data tidak dapat disimpan: ' . implode(', ', $errors));
                return;
            }

            // Success message
            $message = "Absensi berhasil disimpan! ";
            if ($savedCount > 0) {
                $message .= "{$savedCount} data baru ditambahkan. ";
            }
            if ($updatedCount > 0) {
                $message .= "{$updatedCount} data diperbarui.";
            }

            session()->flash('message', $message);

            // Reload data to reflect changes
            $this->loadExistingAbsensis();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.absensi.create');
    }
}
