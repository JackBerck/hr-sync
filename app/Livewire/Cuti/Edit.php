<?php

namespace App\Livewire\Cuti;

use App\Models\Cuti;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Carbon\Carbon;

#[Title('Edit Cuti')]
class Edit extends Component
{
    public Cuti $cuti;

    #[Validate('required|exists:pegawais,id')]
    public $pegawai_id = '';

    #[Validate('required|date')]
    public $tanggal_mulai = '';

    #[Validate('required|date|after_or_equal:tanggal_mulai')]
    public $tanggal_akhir = '';

    #[Validate('required|string|min:10')]
    public $alasan = '';

    protected function messages()
    {
        return [
            'pegawai_id.required' => 'Pegawai wajib dipilih.',
            'pegawai_id.exists' => 'Pegawai yang dipilih tidak valid.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_akhir.required' => 'Tanggal akhir wajib diisi.',
            'tanggal_akhir.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.',
            'alasan.required' => 'Alasan cuti wajib diisi.',
            'alasan.string' => 'Alasan cuti harus berupa teks.',
            'alasan.min' => 'Alasan cuti minimal 10 karakter.',
        ];
    }

    public function mount($id)
    {
        $this->cuti = Cuti::with(['pegawai.jabatan', 'pegawai.unitKerja'])->findOrFail($id);
        $this->pegawai_id = $this->cuti->pegawai_id;
        $this->tanggal_mulai = $this->cuti->tanggal_mulai->format('Y-m-d');
        $this->tanggal_akhir = $this->cuti->tanggal_akhir->format('Y-m-d');
        $this->alasan = $this->cuti->alasan;
    }

    public function update()
    {
        $this->validate();

        // Hitung jumlah hari cuti yang akan diambil
        $jumlahHari = Carbon::parse($this->tanggal_mulai)->diffInDays(Carbon::parse($this->tanggal_akhir)) + 1;
        
        // Cek total cuti yang sudah diambil tahun ini (exclude cuti yang sedang diedit)
        $totalCutiTahunIni = Cuti::getTotalCutiTahunIni($this->pegawai_id, Carbon::parse($this->tanggal_mulai)->year);
        $totalCutiTahunIni -= $this->cuti->jumlah_hari; // Kurangi cuti yang sedang diedit
        
        // Validasi batas maksimal cuti
        if (($totalCutiTahunIni + $jumlahHari) > 12) {
            $sisaCuti = 12 - $totalCutiTahunIni;
            $this->addError('tanggal_akhir', "Pengajuan cuti melebihi batas maksimal. Sisa cuti yang dapat digunakan: {$sisaCuti} hari.");
            return;
        }

        // Cek apakah ada cuti yang overlap (exclude cuti yang sedang diedit)
        $overlapCuti = Cuti::where('pegawai_id', $this->pegawai_id)
            ->where('id', '!=', $this->cuti->id) // Exclude cuti yang sedang diedit
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

        $this->cuti->update([
            'pegawai_id' => $this->pegawai_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_akhir' => $this->tanggal_akhir,
            'alasan' => $this->alasan,
        ]);

        session()->flash('message', 'Data cuti berhasil diperbarui.');

        return $this->redirect(route('cuti.show', $this->cuti->id), navigate: true);
    }

    public function render()
    {
        $pegawais = Pegawai::orderBy('nama')->get();
        
        // Hitung sisa cuti jika pegawai sudah dipilih
        $sisaCuti = null;
        $totalCutiTahunIni = null;
        if ($this->pegawai_id) {
            $totalCutiTahunIni = Cuti::getTotalCutiTahunIni($this->pegawai_id, Carbon::parse($this->tanggal_mulai)->year ?? now()->year);
            $totalCutiTahunIni -= $this->cuti->jumlah_hari; // Kurangi cuti yang sedang diedit
            $sisaCuti = 12 - $totalCutiTahunIni;
        }

        return view('livewire.cuti.edit', compact('pegawais', 'sisaCuti', 'totalCutiTahunIni'));
    }
}