{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\pegawai\create.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('pegawai.index') }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Tambah Pegawai</h1>
            <p class="mt-2 text-gray-600">Tambahkan pegawai baru ke dalam sistem</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="save">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pegawai</h2>
                    <p class="text-sm text-gray-600">Masukkan detail pegawai baru</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Nama --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nama"
                            wire:model="nama"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama lengkap pegawai"
                        >
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Contoh: Ahmad Budiman</p>
                    </div>

                    {{-- NIP --}}
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                            NIP (Nomor Induk Pegawai) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nip"
                            wire:model="nip"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nip') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan NIP pegawai"
                            maxlength="20"
                        >
                        @error('nip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">NIP harus unik dan maksimal 20 karakter</p>
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <label for="jabatan_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="jabatan_id"
                            wire:model="jabatan_id"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jabatan_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="">Pilih jabatan</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">
                                    {{ $jabatan->nama_jabatan }} 
                                    (Tunjangan: Rp {{ number_format($jabatan->tunjangan, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Pilih jabatan sesuai dengan posisi pegawai</p>
                    </div>

                    {{-- Unit Kerja --}}
                    <div>
                        <label for="unit_kerja_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Unit Kerja <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="unit_kerja_id"
                            wire:model="unit_kerja_id"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('unit_kerja_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="">Pilih unit kerja</option>
                            @foreach($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->id }}">
                                    {{ $unitKerja->nama_unit }} - {{ $unitKerja->lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_kerja_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Pilih unit kerja tempat pegawai ditempatkan</p>
                    </div>

                    {{-- Gaji --}}
                    <div>
                        <label for="gaji" class="block text-sm font-medium text-gray-700 mb-2">
                            Gaji <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input 
                                type="number" 
                                id="gaji"
                                wire:model="gaji"
                                class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('gaji') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="0"
                                min="0"
                                step="0.01"
                            >
                        </div>
                        @error('gaji')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Masukkan gaji pokok pegawai (sudah termasuk tunjangan)</p>
                    </div>

                    {{-- Preview --}}
                    @if($nama || $nip)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview Pegawai:
                        </h3>
                        <div class="text-sm text-gray-700 space-y-1">
                            @if($nama)
                                <p><strong>Nama:</strong> {{ $nama }}</p>
                            @endif
                            @if($nip)
                                <p><strong>NIP:</strong> {{ $nip }}</p>
                            @endif
                            @if($jabatan_id && $jabatans->find($jabatan_id))
                                <p><strong>Jabatan:</strong> {{ $jabatans->find($jabatan_id)->nama_jabatan }}</p>
                            @endif
                            @if($unit_kerja_id && $unitKerjas->find($unit_kerja_id))
                                <p><strong>Unit Kerja:</strong> {{ $unitKerjas->find($unit_kerja_id)->nama_unit }}</p>
                            @endif
                            @if($gaji)
                                <p><strong>Gaji:</strong> Rp {{ number_format($gaji, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a wire:navigate href="{{ route('pegawai.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        Batal
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="save">Simpan Pegawai</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Card --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">
                        Tips Pengisian Data Pegawai
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pastikan NIP unik dan tidak duplikasi dengan pegawai lain</li>
                            <li>Pilih jabatan dan unit kerja sesuai penempatan pegawai</li>
                            <li>Gaji yang dimasukkan adalah total gaji termasuk tunjangan jabatan</li>
                            <li>Data yang disimpan dapat diubah melalui menu edit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>