<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Tambah Absensi')]
class Create extends Component
{
    #[Validate('required|exists:pegawais,id')]
    public $pegawai_id = '';

    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required|in:hadir,alpha,sakit,izin')]
    public $status = '';

    public function mount()
    {
        $this->tanggal = today()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        // Cek apakah sudah ada absensi untuk pegawai dan tanggal yang sama
        $existingAbsensi = Absensi::where('pegawai_id', $this->pegawai_id)
            ->whereDate('tanggal', $this->tanggal)
            ->exists();

        if ($existingAbsensi) {
            $this->addError('tanggal', 'Absensi untuk pegawai ini pada tanggal tersebut sudah ada.');
            return;
        }

        Absensi::create([
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data absensi berhasil ditambahkan.');

        return $this->redirect(route('absensi.index'), navigate: true);
    }

    public function render()
    {
        $pegawais = Pegawai::orderBy('nama')->get();

        return view('livewire.absensi.create', compact('pegawais'));
    }
}