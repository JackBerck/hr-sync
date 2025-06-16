{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\unit-kerja\create.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('unit-kerja.index') }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Tambah Unit Kerja</h1>
            <p class="mt-2 text-gray-600">Buat unit kerja baru dalam organisasi</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="save">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Unit Kerja</h2>
                    <p class="text-sm text-gray-600">Masukkan detail unit kerja baru</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Nama Unit Kerja --}}
                    <div>
                        <label for="nama_unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Unit Kerja <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_unit" wire:model="nama_unit"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_unit') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama unit kerja">
                        @error('nama_unit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Contoh: Divisi IT, Bagian Keuangan, Unit SDM</p>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="lokasi" wire:model="lokasi"
                                class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('lokasi') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Masukkan lokasi unit kerja">
                        </div>
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Contoh: Gedung A Lantai 2, Kantor Pusat Jakarta, Cabang
                            Surabaya</p>
                    </div>

                    {{-- Preview --}}
                    @if ($nama_unit || $lokasi)
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
                                Preview Unit Kerja:
                            </h3>
                            <div class="text-sm text-gray-700 space-y-1">
                                @if ($nama_unit)
                                    <p><strong>Nama Unit:</strong> {{ $nama_unit }}</p>
                                @endif
                                @if ($lokasi)
                                    <p><strong>Lokasi:</strong> {{ $lokasi }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a wire:navigate href="{{ route('unit-kerja.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="save">Simpan Unit Kerja</span>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">
                        Tips Pengisian Data Unit Kerja
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pastikan nama unit kerja mudah dipahami dan konsisten</li>
                            <li>Gunakan lokasi yang spesifik untuk memudahkan identifikasi</li>
                            <li>Nama unit kerja harus unik dalam sistem</li>
                            <li>Data ini akan digunakan untuk penempatan pegawai</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
