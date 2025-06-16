<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Edit Unit Kerja')]
class Edit extends Component
{
    public UnitKerja $unitKerja;

    #[Validate('required|string|max:255')]
    public $nama_unit = '';

    #[Validate('required|string|max:255')]
    public $lokasi = '';

    public function mount($id)
    {
        $this->unitKerja = UnitKerja::findOrFail($id);
        $this->nama_unit = $this->unitKerja->nama_unit;
        $this->lokasi = $this->unitKerja->lokasi;
    }

    public function update()
    {
        $this->validate([
            'nama_unit' => 'required|string|max:255|unique:unit_kerjas,nama_unit,' . $this->unitKerja->id,
            'lokasi' => 'required|string|max:255',
        ]);

        $this->unitKerja->update([
            'nama_unit' => $this->nama_unit,
            'lokasi' => $this->lokasi,
        ]);

        session()->flash('message', 'Unit kerja berhasil diperbarui.');

        return $this->redirect(route('unit-kerja.show', $this->unitKerja->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.unit-kerja.edit');
    }
}