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

    public function mount()
    {
        $this->filterBulan = now()->format('Y-m');
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

        return view('livewire.absensi.index', compact('absensis', 'pegawais', 'stats'));
    }
}