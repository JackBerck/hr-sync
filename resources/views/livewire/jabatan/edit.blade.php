{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\jabatan\edit.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('jabatan.show', $jabatan->id) }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Kembali ke Detail
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Edit Jabatan</h1>
            <p class="mt-2 text-gray-600">Perbarui informasi jabatan {{ $jabatan->nama_jabatan }}</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="update">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Jabatan</h2>
                    <p class="text-sm text-gray-600">Perbarui data jabatan sesuai kebutuhan</p>
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
                                <div class="mt-2 text-sm text-blue-700">
                                    <p><strong>Nama:</strong> {{ $jabatan->nama_jabatan }}</p>
                                    <p><strong>Tunjangan:</strong> Rp
                                        {{ number_format($jabatan->tunjangan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nama Jabatan --}}
                    <div>
                        <label for="nama_jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_jabatan" wire:model="nama_jabatan"
                            class="block w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_jabatan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama jabatan">
                        @error('nama_jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tunjangan --}}
                    <div>
                        <label for="tunjangan" class="block text-sm font-medium text-gray-700 mb-2">
                            Tunjangan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" id="tunjangan" wire:model="tunjangan"
                                class="block w-full pl-10 py-2 pr-3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tunjangan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="0" min="0" step="1">
                        </div>
                        @error('tunjangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Masukkan nominal tunjangan tanpa titik atau koma</p>
                    </div>

                    {{-- Preview --}}
                    @if ($nama_jabatan || $tunjangan)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Preview Perubahan:</h3>
                            <div class="text-sm text-gray-700 space-y-1">
                                @if ($nama_jabatan)
                                    <p><strong>Nama Jabatan:</strong> {{ $nama_jabatan }}</p>
                                @endif
                                @if ($tunjangan)
                                    <p><strong>Tunjangan:</strong> Rp {{ number_format($tunjangan, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a wire:navigate href="{{ route('jabatan.show', $jabatan->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Batal
                        </a>
                        <a wire:navigate href="{{ route('jabatan.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Kembali ke Daftar
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span wire:loading.remove wire:target="update">Perbarui Jabatan</span>
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
                        <dt class="text-sm font-medium text-gray-500">ID Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $jabatan->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Jumlah Pegawai</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $jabatan->pegawais()->count() }} orang</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $jabatan->created_at->locale('id')->translatedformat('d F Y H:i') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terakhir Diupdate</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $jabatan->updated_at->locale('id')->translatedformat('d F Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
