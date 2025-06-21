<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Tambah Unit Kerja')]
class Create extends Component
{
    #[Validate('required|string|max:255|unique:unit_kerjas,nama_unit')]
    public $nama_unit = '';

    #[Validate('required|string|max:255')]
    public $lokasi = '';

    protected function messages()
    {
        return [
            'nama_unit.required' => 'Nama unit kerja wajib diisi.',
            'nama_unit.string' => 'Nama unit kerja harus berupa teks.',
            'nama_unit.max' => 'Nama unit kerja tidak boleh lebih dari 255 karakter.',
            'nama_unit.unique' => 'Nama unit kerja sudah ada.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.string' => 'Lokasi harus berupa teks.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
        ];
    }

    public function save()
    {
        $this->validate();

        UnitKerja::create([
            'nama_unit' => $this->nama_unit,
            'lokasi' => $this->lokasi,
        ]);

        session()->flash('message', 'Unit kerja berhasil ditambahkan.');

        return $this->redirect(route('unit-kerja.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.unit-kerja.create');
    }
}