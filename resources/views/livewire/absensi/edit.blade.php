<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('absensi.show', $absensi->id) }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Detail
                </a>
            </div>
            <div class="flex items-center mt-4">
                {{-- Avatar --}}
                <div class="flex-shrink-0 h-12 w-12">
                    <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center">
                        <span class="text-lg font-medium text-white">
                            {{ strtoupper(substr($absensi->pegawai->nama, 0, 2)) }}
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Absensi</h1>
                    <p class="mt-2 text-gray-600">Perbarui data absensi {{ $absensi->pegawai->nama }}</p>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <form wire:submit="update">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Edit Data Absensi</h2>
                    <p class="text-sm text-gray-600">Perbarui informasi kehadiran pegawai</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Current Info Display --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Data Absensi Saat Ini
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <p><strong>Pegawai:</strong> {{ $absensi->pegawai->nama }}</p>
                                    <p><strong>Tanggal:</strong> {{ $absensi->tanggal->format('d M Y') }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($absensi->status) }}</p>
                                    <p><strong>Dicatat:</strong> {{ $absensi->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pegawai --}}
                    <div>
                        <label for="pegawai_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pegawai <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="pegawai_id"
                            wire:model="pegawai_id"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pegawai_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="">Pilih pegawai</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}">
                                    {{ $pegawai->nama }} ({{ $pegawai->nip }})
                                    @if($pegawai->jabatan)
                                        - {{ $pegawai->jabatan->nama_jabatan }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('pegawai_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal"
                            wire:model="tanggal"
                            class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Pilih tanggal kehadiran</p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Kehadiran <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                            {{-- Hadir --}}
                            <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all duration-200 
                                   @if($status === 'hadir') 
                                       border-green-500 bg-green-50 ring-2 ring-green-200 
                                   @else 
                                       border-gray-300 hover:border-green-300 hover:bg-green-25 
                                   @endif">
                                <input 
                                    type="radio" 
                                    wire:model.live="status" 
                                    value="hadir"
                                    class="sr-only"
                                >
                                <div class="text-center">
                                    <div class="flex justify-center mb-2">
                                        <div class="w-8 h-8 rounded-full transition-all duration-200 
                                                   {{ $status === 'hadir' ? 'bg-green-500 scale-110' : 'bg-gray-300' }} 
                                                   flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium transition-colors duration-200 
                                               {{ $status === 'hadir' ? 'text-green-700' : 'text-gray-700' }}">
                                        Hadir
                                    </span>
                                </div>
                            </label>

                            {{-- Alpha --}}
                            <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all duration-200 
                                   @if($status === 'alpha') 
                                       border-red-500 bg-red-50 ring-2 ring-red-200 
                                   @else 
                                       border-gray-300 hover:border-red-300 hover:bg-red-25 
                                   @endif">
                                <input 
                                    type="radio" 
                                    wire:model.live="status" 
                                    value="alpha"
                                    class="sr-only"
                                >
                                <div class="text-center">
                                    <div class="flex justify-center mb-2">
                                        <div class="w-8 h-8 rounded-full transition-all duration-200 
                                                   {{ $status === 'alpha' ? 'bg-red-500 scale-110' : 'bg-gray-300' }} 
                                                   flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium transition-colors duration-200 
                                               {{ $status === 'alpha' ? 'text-red-700' : 'text-gray-700' }}">
                                        Alpha
                                    </span>
                                </div>
                            </label>

                            {{-- Sakit --}}
                            <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all duration-200 
                                   @if($status === 'sakit') 
                                       border-yellow-500 bg-yellow-50 ring-2 ring-yellow-200 
                                   @else 
                                       border-gray-300 hover:border-yellow-300 hover:bg-yellow-25 
                                   @endif">
                                <input 
                                    type="radio" 
                                    wire:model.live="status" 
                                    value="sakit"
                                    class="sr-only"
                                >
                                <div class="text-center">
                                    <div class="flex justify-center mb-2">
                                        <div class="w-8 h-8 rounded-full transition-all duration-200 
                                                   {{ $status === 'sakit' ? 'bg-yellow-500 scale-110' : 'bg-gray-300' }} 
                                                   flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium transition-colors duration-200 
                                               {{ $status === 'sakit' ? 'text-yellow-700' : 'text-gray-700' }}">
                                        Sakit
                                    </span>
                                </div>
                            </label>

                            {{-- Izin --}}
                            <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer transition-all duration-200 
                                   @if($status === 'izin') 
                                       border-blue-500 bg-blue-50 ring-2 ring-blue-200 
                                   @else 
                                       border-gray-300 hover:border-blue-300 hover:bg-blue-25 
                                   @endif">
                                <input 
                                    type="radio" 
                                    wire:model.live="status" 
                                    value="izin"
                                    class="sr-only"
                                >
                                <div class="text-center">
                                    <div class="flex justify-center mb-2">
                                        <div class="w-8 h-8 rounded-full transition-all duration-200 
                                                   {{ $status === 'izin' ? 'bg-blue-500 scale-110' : 'bg-gray-300' }} 
                                                   flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium transition-colors duration-200 
                                               {{ $status === 'izin' ? 'text-blue-700' : 'text-gray-700' }}">
                                        Izin
                                    </span>
                                </div>
                            </label>
                        </div>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Description --}}
                    @if($status)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Keterangan Status:</h3>
                        <div class="text-sm text-gray-700">
                            @switch($status)
                                @case('hadir')
                                    <p>✅ <strong>Hadir:</strong> Pegawai hadir dan bekerja sesuai jadwal.</p>
                                    @break
                                @case('alpha')
                                    <p>❌ <strong>Alpha:</strong> Pegawai tidak hadir tanpa keterangan.</p>
                                    @break
                                @case('sakit')
                                    <p>🏥 <strong>Sakit:</strong> Pegawai tidak hadir karena sakit (dengan/tanpa surat dokter).</p>
                                    @break
                                @case('izin')
                                    <p>📝 <strong>Izin:</strong> Pegawai tidak hadir dengan izin atau keperluan tertentu.</p>
                                    @break
                            @endswitch
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a wire:navigate href="{{ route('absensi.show', $absensi->id) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Batal
                        </a>
                        <a wire:navigate href="{{ route('absensi.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Kembali ke Daftar
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button 
                            type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="update">Perbarui Absensi</span>
                            <span wire:loading wire:target="update">Memperbarui...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Additional Info Card --}}
        <div class="mt-6 bg-white rounded-lg shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Perubahan</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">ID Absensi</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $absensi->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->created_at->format('d F Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terakhir Diupdate</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->updated_at->format('d F Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Selisih Waktu</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->updated_at->diffForHumans() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>