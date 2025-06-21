{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\pegawai\edit.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('pegawai.show', $pegawai->id) }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Kembali ke Detail
                </a>
            </div>
            <div class="flex items-center mt-4">
                {{-- Avatar --}}
                <div class="flex-shrink-0 h-12 w-12">
                    <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center">
                        <span class="text-lg font-medium text-white">
                            {{ strtoupper(substr($pegawai->nama, 0, 2)) }}
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pegawai</h1>
                    <p class="mt-2 text-gray-600">Perbarui informasi pegawai {{ $pegawai->nama }}</p>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="update">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pegawai</h2>
                    <p class="text-sm text-gray-600">Perbarui data pegawai sesuai kebutuhan</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Current Info Display --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Data Saat Ini
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <p><strong>Nama:</strong> {{ $pegawai->nama }}</p>
                                    <p><strong>NIP:</strong> {{ $pegawai->nip }}</p>
                                    <p><strong>Jabatan:</strong> {{ $pegawai->jabatan->nama_jabatan ?? '-' }}</p>
                                    <p><strong>Unit Kerja:</strong> {{ $pegawai->unitKerja->nama_unit ?? '-' }}</p>
                                    <p><strong>Gaji:</strong> Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" wire:model="nama"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama lengkap pegawai">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                            NIP (Nomor Induk Pegawai) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nip" wire:model="nip"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nip') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan NIP pegawai" maxlength="20">
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
                        <select id="jabatan_id" wire:model="jabatan_id"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jabatan_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="">Pilih jabatan</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">
                                    {{ $jabatan->nama_jabatan }}
                                    (Tunjangan: Rp {{ number_format($jabatan->tunjangan, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Unit Kerja --}}
                    <div>
                        <label for="unit_kerja_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Unit Kerja <span class="text-red-500">*</span>
                        </label>
                        <select id="unit_kerja_id" wire:model="unit_kerja_id"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('unit_kerja_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="">Pilih unit kerja</option>
                            @foreach ($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->id }}">
                                    {{ $unitKerja->nama_unit }} - {{ $unitKerja->lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_kerja_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                            <input type="number" id="gaji" wire:model="gaji"
                                class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('gaji') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="0" min="0" step="0.01">
                        </div>
                        @error('gaji')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Masukkan gaji pokok pegawai (sudah termasuk tunjangan)</p>
                    </div>

                    {{-- Preview Changes --}}
                    @if ($nama || $nip)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-2 flex items-center">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Preview Perubahan:
                            </h3>
                            <div class="text-sm text-gray-700 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @if ($nama)
                                    <p><strong>Nama:</strong> {{ $nama }}</p>
                                @endif
                                @if ($nip)
                                    <p><strong>NIP:</strong> {{ $nip }}</p>
                                @endif
                                @if ($jabatan_id && $jabatans->find($jabatan_id))
                                    <p><strong>Jabatan:</strong> {{ $jabatans->find($jabatan_id)->nama_jabatan }}</p>
                                @endif
                                @if ($unit_kerja_id && $unitKerjas->find($unit_kerja_id))
                                    <p><strong>Unit Kerja:</strong> {{ $unitKerjas->find($unit_kerja_id)->nama_unit }}
                                    </p>
                                @endif
                                @if ($gaji)
                                    <p><strong>Gaji:</strong> Rp {{ number_format($gaji, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a wire:navigate href="{{ route('pegawai.show', $pegawai->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Batal
                        </a>
                        <a wire:navigate href="{{ route('pegawai.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Kembali ke Daftar
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span wire:loading.remove wire:target="update">Perbarui Pegawai</span>
                            <span wire:loading wire:target="update">Memperbarui...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Additional Info Card --}}
        <div class="mt-6 bg-white rounded-lg shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">ID Pegawai</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $pegawai->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $pegawai->created_at->locale('id')->translatedformat('d F Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terakhir Diupdate</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $pegawai->updated_at->locale('id')->translatedformat('d F Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
