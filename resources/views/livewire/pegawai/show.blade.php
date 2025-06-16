{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\pegawai\show.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a wire:navigate href="{{ route('pegawai.index') }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0 h-16 w-16">
                        <div class="h-16 w-16 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-xl font-medium text-white">
                                {{ strtoupper(substr($pegawai->nama, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $pegawai->nama }}</h1>
                        <p class="mt-1 text-gray-600">{{ $pegawai->nip }}</p>
                        <div class="mt-2 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a wire:navigate href="{{ route('pegawai.edit', $pegawai->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Pegawai
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Information --}}
            <div class="lg:col-span-2">
                {{-- Basic Information --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pegawai</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $pegawai->nama }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">NIP</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $pegawai->nip }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Jabatan</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</span>
                                        @if($pegawai->jabatan)
                                            <span class="text-xs text-gray-500">
                                                Tunjangan: Rp {{ number_format($pegawai->jabatan->tunjangan, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Unit Kerja</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $pegawai->unitKerja->nama_unit ?? '-' }}</span>
                                        @if($pegawai->unitKerja)
                                            <span class="text-xs text-gray-500 mt-1">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $pegawai->unitKerja->lokasi }}
                                            </span>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Gaji</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-semibold text-green-600">
                                            Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}
                                        </span>
                                        @if($pegawai->jabatan)
                                            <span class="text-xs text-gray-500">
                                                (Termasuk tunjangan jabatan)
                                            </span>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                {{-- System Information --}}
                <div class="mt-6 bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Sistem</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Dibuat Pada</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $pegawai->created_at->format('d F Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $pegawai->created_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $pegawai->updated_at->format('d F Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $pegawai->updated_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Sidebar Stats --}}
            <div class="lg:col-span-1">
                {{-- Summary Card --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            {{-- Status --}}
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-green-900">Status</p>
                                    <p class="text-lg font-bold text-green-600">Aktif</p>
                                </div>
                                <div class="p-3 bg-green-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Jabatan Info --}}
                            @if($pegawai->jabatan)
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-900">Jabatan</p>
                                    <p class="text-sm text-blue-600 break-words">{{ $pegawai->jabatan->nama_jabatan }}</p>
                                    <p class="text-xs text-blue-500 mt-1">
                                        Tunjangan: Rp {{ number_format($pegawai->jabatan->tunjangan, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-3 bg-blue-600 rounded-full ml-3 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H8a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h2"></path>
                                    </svg>
                                </div>
                            </div>
                            @endif

                            {{-- Unit Kerja Info --}}
                            @if($pegawai->unitKerja)
                            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-purple-900">Unit Kerja</p>
                                    <p class="text-sm text-purple-600 break-words">{{ $pegawai->unitKerja->nama_unit }}</p>
                                    <p class="text-xs text-purple-500 mt-1">{{ $pegawai->unitKerja->lokasi }}</p>
                                </div>
                                <div class="p-3 bg-purple-600 rounded-full ml-3 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                            @endif

                            {{-- Gaji Info --}}
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-yellow-900">Total Gaji</p>
                                    <p class="text-lg font-bold text-yellow-600">
                                        Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-3 bg-yellow-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-6 bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a wire:navigate href="{{ route('pegawai.edit', $pegawai->id) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Pegawai
                            </a>
                            
                            <a wire:navigate href="{{ route('pegawai.index') }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Lihat Semua Pegawai
                            </a>

                            {{-- View Jabatan Detail --}}
                            @if($pegawai->jabatan)
                            <a wire:navigate href="{{ route('jabatan.show', $pegawai->jabatan->id) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H8a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h2"></path>
                                </svg>
                                Detail Jabatan
                            </a>
                            @endif

                            {{-- View Unit Kerja Detail --}}
                            @if($pegawai->unitKerja)
                            <a wire:navigate href="{{ route('unit-kerja.show', $pegawai->unitKerja->id) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Detail Unit Kerja
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>