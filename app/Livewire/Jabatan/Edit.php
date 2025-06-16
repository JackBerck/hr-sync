<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Edit Jabatan')]
class Edit extends Component
{
    public Jabatan $jabatan;

    #[Validate('required|string|max:255')]
    public $nama_jabatan = '';

    #[Validate('required|numeric|min:0')]
    public $tunjangan = '';

    public function mount($id)
    {
        $this->jabatan = Jabatan::findOrFail($id);
        $this->nama_jabatan = $this->jabatan->nama_jabatan;
        $this->tunjangan = $this->jabatan->tunjangan;
    }

    public function update()
    {
        $this->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $this->jabatan->id,
            'tunjangan' => 'required|numeric|min:0',
        ]);

        $this->jabatan->update([
            'nama_jabatan' => $this->nama_jabatan,
            'tunjangan' => $this->tunjangan,
        ]);

        session()->flash('message', 'Jabatan berhasil diperbarui.');

        return $this->redirect(route('jabatan.show', $this->jabatan->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.jabatan.edit');
    }
}