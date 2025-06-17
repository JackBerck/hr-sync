<?php

namespace App\Livewire\Cuti;

use App\Models\Cuti;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Cuti')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterPegawai = '';
    public $filterTahun = '';
    public $showDeleteModal = false;
    public $cutiToDelete = null;

    public function mount()
    {
        $this->filterTahun = now()->year;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterPegawai()
    {
        $this->resetPage();
    }

    public function updatingFilterTahun()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->cutiToDelete = $id;
    }

    public function destroy()
    {
        if ($this->cutiToDelete) {
            $cuti = Cuti::findOrFail($this->cutiToDelete);
            $cuti->delete();

            $this->showDeleteModal = false;
            $this->cutiToDelete = null;

            session()->flash('message', 'Data cuti berhasil dihapus.');
        }
    }

    public function render()
    {
        $cutis = Cuti::with(['pegawai'])
            ->when($this->search, function ($query) {
                $query->whereHas('pegawai', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterPegawai, function ($query) {
                $query->where('pegawai_id', $this->filterPegawai);
            })
            ->when($this->filterTahun, function ($query) {
                $query->whereYear('tanggal_mulai', $this->filterTahun);
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        $pegawais = Pegawai::orderBy('nama')->get();
        $tahuns = Cuti::selectRaw('YEAR(tanggal_mulai) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('livewire.cuti.index', compact('cutis', 'pegawais', 'tahuns'));
    }
}