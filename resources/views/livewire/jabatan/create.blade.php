{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\jabatan\create.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a href="{{ route('jabatan.index') }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Tambah Jabatan</h1>
            <p class="mt-2 text-gray-600">Buat jabatan baru dalam organisasi</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="save">
                <div class="p-6 space-y-6">
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
                                class="block w-full pl-10 rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tunjangan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="0" min="0" step="1">
                        </div>
                        @error('tunjangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a href="{{ route('jabatan.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="save">Simpan</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
