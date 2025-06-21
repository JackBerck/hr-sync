<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Edit Jabatan')]
class Edit extends Component
{
    public Jabatan $jabatan;

    #[Validate('required|string|max:255')]
    public $nama_jabatan = '';

    #[Validate('required|numeric|min:0')]
    public $tunjangan = '';

    protected function messages()
    {
        return [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.string' => 'Nama jabatan harus berupa teks.',
            'nama_jabatan.max' => 'Nama jabatan tidak boleh lebih dari 255 karakter.',
            'nama_jabatan.unique' => 'Nama jabatan sudah ada.',
            'tunjangan.required' => 'Tunjangan wajib diisi.',
            'tunjangan.numeric' => 'Tunjangan harus berupa angka.',
            'tunjangan.min' => 'Tunjangan minimal 0.',
        ];
    }

    public function mount($id)
    {
        $this->jabatan = Jabatan::findOrFail($id);
        $this->nama_jabatan = $this->jabatan->nama_jabatan;
        $this->tunjangan = $this->jabatan->tunjangan;
    }

    public function update()
    {
        $this->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $this->jabatan->id,
            'tunjangan' => 'required|numeric|min:0',
        ]);

        $this->jabatan->update([
            'nama_jabatan' => $this->nama_jabatan,
            'tunjangan' => $this->tunjangan,
        ]);

        session()->flash('message', 'Jabatan berhasil diperbarui.');

        return $this->redirect(route('jabatan.show', $this->jabatan->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.jabatan.edit');
    }
}