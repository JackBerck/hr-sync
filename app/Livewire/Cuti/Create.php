<?php

namespace App\Livewire\Cuti;

use App\Models\Cuti;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Carbon\Carbon;

#[Title('Pengajuan Cuti')]
class Create extends Component
{
    #[Validate('required|exists:pegawais,id')]
    public $pegawai_id = '';

    #[Validate('required|date|after_or_equal:today')]
    public $tanggal_mulai = '';

    #[Validate('required|date|after_or_equal:tanggal_mulai')]
    public $tanggal_akhir = '';

    #[Validate('required|string|min:10')]
    public $alasan = '';

    public function save()
    {
        $this->validate();

        // Hitung jumlah hari cuti yang akan diambil
        $jumlahHari = Carbon::parse($this->tanggal_mulai)->diffInDays(Carbon::parse($this->tanggal_akhir)) + 1;
        
        // Cek total cuti yang sudah diambil tahun ini
        $totalCutiTahunIni = Cuti::getTotalCutiTahunIni($this->pegawai_id, Carbon::parse($this->tanggal_mulai)->year);
        
        // Validasi batas maksimal cuti
        if (($totalCutiTahunIni + $jumlahHari) > 12) {
            $sisaCuti = Cuti::getSisaCuti($this->pegawai_id, Carbon::parse($this->tanggal_mulai)->year);
            $this->addError('tanggal_akhir', "Pengajuan cuti melebihi batas maksimal. Sisa cuti Anda: {$sisaCuti} hari.");
            return;
        }

        // Cek apakah ada cuti yang overlap
        $overlapCuti = Cuti::where('pegawai_id', $this->pegawai_id)
            ->where(function ($query) {
                $query->whereBetween('tanggal_mulai', [$this->tanggal_mulai, $this->tanggal_akhir])
                    ->orWhereBetween('tanggal_akhir', [$this->tanggal_mulai, $this->tanggal_akhir])
                    ->orWhere(function ($q) {
                        $q->where('tanggal_mulai', '<=', $this->tanggal_mulai)
                          ->where('tanggal_akhir', '>=', $this->tanggal_akhir);
                    });
            })
            ->exists();

        if ($overlapCuti) {
            $this->addError('tanggal_mulai', 'Tanggal cuti yang dipilih bertabrakan dengan cuti yang sudah ada.');
            return;
        }

        Cuti::create([
            'pegawai_id' => $this->pegawai_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_akhir' => $this->tanggal_akhir,
            'alasan' => $this->alasan,
        ]);

        session()->flash('message', 'Pengajuan cuti berhasil disubmit.');

        return $this->redirect(route('cuti.index'), navigate: true);
    }

    public function render()
    {
        $pegawais = Pegawai::orderBy('nama')->get();
        
        // Hitung sisa cuti jika pegawai sudah dipilih
        $sisaCuti = null;
        $totalCutiTahunIni = null;
        if ($this->pegawai_id) {
            $totalCutiTahunIni = Cuti::getTotalCutiTahunIni($this->pegawai_id);
            $sisaCuti = Cuti::getSisaCuti($this->pegawai_id);
        }

        return view('livewire.cuti.create', compact('pegawais', 'sisaCuti', 'totalCutiTahunIni'));
    }
}