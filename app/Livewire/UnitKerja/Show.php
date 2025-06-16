<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Unit Kerja')]
class Show extends Component
{
    public UnitKerja $unitKerja;

    public function mount($id)
    {
        $this->unitKerja = UnitKerja::withCount('pegawais')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.unit-kerja.show');
    }
}