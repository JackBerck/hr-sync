<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Edit Absensi')]
class Edit extends Component
{
    public Absensi $absensi;

    #[Validate('required|exists:pegawais,id')]
    public $pegawai_id = '';

    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required|in:hadir,alpha,sakit,izin')]
    public $status = '';

    public function mount($id)
    {
        $this->absensi = Absensi::with(['pegawai.jabatan', 'pegawai.unitKerja'])->findOrFail($id);
        $this->pegawai_id = $this->absensi->pegawai_id;
        $this->tanggal = $this->absensi->tanggal->format('Y-m-d');
        $this->status = $this->absensi->status;
    }

    public function update()
    {
        $this->validate();

        // Cek apakah sudah ada absensi untuk pegawai dan tanggal yang sama (exclude yang sedang diedit)
        $existingAbsensi = Absensi::where('pegawai_id', $this->pegawai_id)
            ->whereDate('tanggal', $this->tanggal)
            ->where('id', '!=', $this->absensi->id)
            ->exists();

        if ($existingAbsensi) {
            $this->addError('tanggal', 'Absensi untuk pegawai ini pada tanggal tersebut sudah ada.');
            return;
        }

        $this->absensi->update([
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data absensi berhasil diperbarui.');

        return $this->redirect(route('absensi.show', $this->absensi->id), navigate: true);
    }

    public function render()
    {
        $pegawais = Pegawai::orderBy('nama')->get();

        return view('livewire.absensi.edit', compact('pegawais'));
    }
}