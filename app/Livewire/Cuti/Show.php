<?php

namespace App\Livewire\Cuti;

use App\Models\Cuti;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Cuti')]
class Show extends Component
{
    public Cuti $cuti;

    public function mount($id)
    {
        $this->cuti = Cuti::with(['pegawai.jabatan', 'pegawai.unitKerja'])->findOrFail($id);
    }

    public function render()
    {
        // Hitung statistik cuti pegawai
        $totalCutiTahunIni = Cuti::getTotalCutiTahunIni($this->cuti->pegawai_id, $this->cuti->tanggal_mulai->year);
        $sisaCuti = Cuti::getSisaCuti($this->cuti->pegawai_id, $this->cuti->tanggal_mulai->year);

        return view('livewire.cuti.show', compact('totalCutiTahunIni', 'sisaCuti'));
    }
}