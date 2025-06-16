<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Tambah Pegawai')]
class Create extends Component
{
    #[Validate('required|string|max:255')]
    public $nama = '';

    #[Validate('required|string|max:20|unique:pegawais,nip')]
    public $nip = '';

    #[Validate('required|exists:jabatans,id')]
    public $jabatan_id = '';

    #[Validate('required|exists:unit_kerjas,id')]
    public $unit_kerja_id = '';

    #[Validate('required|numeric|min:0')]
    public $gaji = '';

    public function save()
    {
        $this->validate();

        Pegawai::create([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'jabatan_id' => $this->jabatan_id,
            'unit_kerja_id' => $this->unit_kerja_id,
            'gaji' => $this->gaji,
        ]);

        session()->flash('message', 'Pegawai berhasil ditambahkan.');

        return $this->redirect(route('pegawai.index'), navigate: true);
    }

    public function render()
    {
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $unitKerjas = UnitKerja::orderBy('nama_unit')->get();

        return view('livewire.pegawai.create', compact('jabatans', 'unitKerjas'));
    }
}