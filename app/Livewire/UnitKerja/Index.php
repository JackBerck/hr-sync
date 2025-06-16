<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Unit Kerja')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $unitKerjaToDelete = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->unitKerjaToDelete = $id;
    }

    public function destroy()
    {
        if ($this->unitKerjaToDelete) {
            $unitKerja = UnitKerja::findOrFail($this->unitKerjaToDelete);
            $unitKerja->delete();

            $this->showDeleteModal = false;
            $this->unitKerjaToDelete = null;

            session()->flash('message', 'Unit kerja berhasil dihapus.');
        }
    }

    public function render()
    {
        $unitKerjas = UnitKerja::withCount('pegawais')->when($this->search, function ($query) {
            $query->where('nama_unit', 'like', '%' . $this->search . '%');
        })
            ->orderBy('nama_unit', 'asc')
            ->paginate(10);

        return view('livewire.unit-kerja.index', compact('unitKerjas'));
    }
}
