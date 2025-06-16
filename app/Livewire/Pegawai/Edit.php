<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Edit Pegawai')]
class Edit extends Component
{
    public Pegawai $pegawai;

    #[Validate('required|string|max:255')]
    public $nama = '';

    #[Validate('required|string|max:20')]
    public $nip = '';

    #[Validate('required|exists:jabatans,id')]
    public $jabatan_id = '';

    #[Validate('required|exists:unit_kerjas,id')]
    public $unit_kerja_id = '';

    #[Validate('required|numeric|min:0')]
    public $gaji = '';

    public function mount($id)
    {
        $this->pegawai = Pegawai::with(['jabatan', 'unitKerja'])->findOrFail($id);
        $this->nama = $this->pegawai->nama;
        $this->nip = $this->pegawai->nip;
        $this->jabatan_id = $this->pegawai->jabatan_id;
        $this->unit_kerja_id = $this->pegawai->unit_kerja_id;
        $this->gaji = $this->pegawai->gaji;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:pegawais,nip,' . $this->pegawai->id,
            'jabatan_id' => 'required|exists:jabatans,id',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'gaji' => 'required|numeric|min:0',
        ]);

        $this->pegawai->update([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'jabatan_id' => $this->jabatan_id,
            'unit_kerja_id' => $this->unit_kerja_id,
            'gaji' => $this->gaji,
        ]);

        session()->flash('message', 'Pegawai berhasil diperbarui.');

        return $this->redirect(route('pegawai.show', $this->pegawai->id), navigate: true);
    }

    public function render()
    {
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $unitKerjas = UnitKerja::orderBy('nama_unit')->get();

        return view('livewire.pegawai.edit', compact('jabatans', 'unitKerjas'));
    }
}