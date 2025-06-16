<?php

namespace App\Livewire\Pegawai;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Pegawai')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterJabatan = '';
    public $filterUnitKerja = '';
    public $showDeleteModal = false;
    public $pegawaiToDelete = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJabatan()
    {
        $this->resetPage();
    }

    public function updatingFilterUnitKerja()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->pegawaiToDelete = $id;
    }

    public function destroy()
    {
        if ($this->pegawaiToDelete) {
            $pegawai = Pegawai::findOrFail($this->pegawaiToDelete);
            $pegawai->delete();

            $this->showDeleteModal = false;
            $this->pegawaiToDelete = null;

            session()->flash('message', 'Pegawai berhasil dihapus.');
        }
    }

    public function render()
    {
        $pegawais = Pegawai::with(['jabatan', 'unitKerja'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterJabatan, function ($query) {
                $query->where('jabatan_id', $this->filterJabatan);
            })
            ->when($this->filterUnitKerja, function ($query) {
                $query->where('unit_kerja_id', $this->filterUnitKerja);
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $unitKerjas = UnitKerja::orderBy('nama_unit')->get();

        return view('livewire.pegawai.index', compact('pegawais', 'jabatans', 'unitKerjas'));
    }
}