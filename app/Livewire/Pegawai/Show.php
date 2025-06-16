<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Pegawai')]
class Show extends Component
{
    public Pegawai $pegawai;

    public function mount($id)
    {
        $this->pegawai = Pegawai::with(['jabatan', 'unitKerja'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pegawai.show');
    }
}