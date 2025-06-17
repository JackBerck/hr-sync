<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('cuti.index') }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Pengajuan Cuti</h1>
            <p class="mt-2 text-gray-600">Ajukan cuti baru dengan maksimal 12 hari per tahun</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="save">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Formulir Pengajuan Cuti</h2>
                    <p class="text-sm text-gray-600">Lengkapi informasi pengajuan cuti dengan teliti</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Pegawai --}}
                    <div>
                        <label for="pegawai_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pegawai <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="pegawai_id"
                            wire:model.live="pegawai_id"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pegawai_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="">Pilih pegawai</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}">
                                    {{ $pegawai->nama }} ({{ $pegawai->nip }})
                                </option>
                            @endforeach
                        </select>
                        @error('pegawai_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sisa Cuti Info --}}
                    @if($pegawai_id && $sisaCuti !== null)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Informasi Cuti Tahun {{ now()->year }}
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <p class="font-medium">Total Cuti</p>
                                            <p class="text-lg">12 hari</p>
                                        </div>
                                        <div>
                                            <p class="font-medium">Sudah Digunakan</p>
                                            <p class="text-lg">{{ $totalCutiTahunIni }} hari</p>
                                        </div>
                                        <div>
                                            <p class="font-medium">Sisa Cuti</p>
                                            <p class="text-lg font-bold {{ $sisaCuti > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $sisaCuti }} hari
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Tanggal Mulai --}}
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai Cuti <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_mulai"
                            wire:model="tanggal_mulai"
                            min="{{ now()->format('Y-m-d') }}"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_mulai') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Tanggal mulai cuti tidak boleh lebih awal dari hari ini</p>
                    </div>

                    {{-- Tanggal Akhir --}}
                    <div>
                        <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Akhir Cuti <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_akhir"
                            wire:model="tanggal_akhir"
                            min="{{ $tanggal_mulai ?: now()->format('Y-m-d') }}"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_akhir') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                        @error('tanggal_akhir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Tanggal akhir tidak boleh lebih awal dari tanggal mulai</p>
                    </div>

                    {{-- Preview Durasi --}}
                    @if($tanggal_mulai && $tanggal_akhir)
                    @php
                        $durasi = \Carbon\Carbon::parse($tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($tanggal_akhir)) + 1;
                    @endphp
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">
                                    Durasi Cuti: {{ $durasi }} hari
                                </h3>
                                <p class="text-sm text-yellow-700">
                                    Dari {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d F Y') }} 
                                    sampai {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d F Y') }}
                                </p>
                                @if($pegawai_id && $sisaCuti !== null)
                                    <p class="text-sm text-yellow-700 mt-1">
                                        @if($durasi <= $sisaCuti)
                                            ✅ Durasi cuti masih dalam batas yang diperbolehkan
                                        @else
                                            ❌ Durasi cuti melebihi sisa cuti yang tersedia ({{ $sisaCuti }} hari)
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Alasan --}}
                    <div>
                        <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Cuti <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="alasan"
                            wire:model="alasan"
                            rows="4"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('alasan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Jelaskan alasan pengajuan cuti (minimal 10 karakter)"
                        ></textarea>
                        @error('alasan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Minimal 10 karakter. Contoh: Liburan keluarga, keperluan pribadi, dll.</p>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a wire:navigate href="{{ route('cuti.index') }}" 
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
                        <span wire:loading.remove wire:target="save">Ajukan Cuti</span>
                        <span wire:loading wire:target="save">Mengajukan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Rules Card --}}
        <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Aturan Pengajuan Cuti
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Maksimal cuti yang dapat diambil adalah <strong>12 hari per tahun</strong></li>
                            <li>Tanggal cuti tidak boleh bertabrakan dengan cuti yang sudah ada</li>
                            <li>Pengajuan cuti harus dilakukan minimal untuk hari ini atau masa depan</li>
                            <li>Alasan cuti harus diisi dengan jelas dan lengkap</li>
                            <li>Sistem akan otomatis menghitung durasi cuti berdasarkan tanggal yang dipilih</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>