<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Jabatan')]
class Show extends Component
{
    public Jabatan $jabatan;

    public function mount($id)
    {
        $this->jabatan = Jabatan::withCount('pegawais')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.jabatan.show');
    }
}