<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Jabatan')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $jabatanToDelete = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->jabatanToDelete = $id;
    }

    public function destroy()
    {
        if ($this->jabatanToDelete) {
            $jabatan = Jabatan::findOrFail($this->jabatanToDelete);
            $jabatan->delete();

            $this->showDeleteModal = false;
            $this->jabatanToDelete = null;

            session()->flash('message', 'Jabatan berhasil dihapus.');
        }
    }

    public function render()
    {
        $jabatans = Jabatan::withCount('pegawais')->when($this->search, function ($query) {
            $query->where('nama_jabatan', 'like', '%' . $this->search . '%');
        })
            ->orderBy('nama_jabatan', 'asc')
            ->paginate(10);

        return view('livewire.jabatan.index', compact('jabatans'));
    }
}
