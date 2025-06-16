<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Tambah Jabatan')]
class Create extends Component
{
    #[Validate('required|string|max:255|unique:jabatans,nama_jabatan')]
    public $nama_jabatan = '';

    #[Validate('required|numeric|min:0')]
    public $tunjangan = '';

    public function save()
    {
        $this->validate();

        Jabatan::create([
            'nama_jabatan' => $this->nama_jabatan,
            'tunjangan' => $this->tunjangan,
        ]);

        session()->flash('message', 'Jabatan berhasil ditambahkan.');

        return $this->redirect(route('jabatan.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.jabatan.create');
    }
}