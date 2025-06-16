{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\unit-kerja\show.blade.php --}}
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a wire:navigate href="{{ route('unit-kerja.index') }}" 
                   class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Unit Kerja</h1>
                    <p class="mt-2 text-gray-600">Informasi lengkap tentang {{ $unitKerja->nama_unit }}</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a wire:navigate href="{{ route('unit-kerja.edit', $unitKerja->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Unit Kerja
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Information --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Unit Kerja</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">ID Unit Kerja</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    #{{ $unitKerja->id }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Nama Unit Kerja</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $unitKerja->nama_unit }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Lokasi</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $unitKerja->lokasi }}
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Jumlah Pegawai</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $unitKerja->pegawais_count }} orang
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                {{-- Timestamps Information --}}
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
                                        <span>{{ $unitKerja->created_at->format('d F Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $unitKerja->created_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $unitKerja->updated_at->format('d F Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $unitKerja->updated_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            @if($unitKerja->deleted_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Dihapus Pada</dt>
                                <dd class="text-sm text-gray-900 bg-red-50 px-3 py-2 rounded-md border border-red-200">
                                    <div class="flex flex-col">
                                        <span class="text-red-700">{{ $unitKerja->deleted_at->format('d F Y') }}</span>
                                        <span class="text-xs text-red-500">{{ $unitKerja->deleted_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Sidebar Stats --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Statistik</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            {{-- Total Pegawai --}}
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-green-900">Total Pegawai</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $unitKerja->pegawais_count }}</p>
                                </div>
                                <div class="p-3 bg-green-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Location Info --}}
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-900">Lokasi</p>
                                    <p class="text-sm text-blue-600 break-words">{{ $unitKerja->lokasi }}</p>
                                </div>
                                <div class="p-3 bg-blue-600 rounded-full ml-3 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Creation Date Info --}}
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Dibuat</p>
                                    <p class="text-sm text-gray-600">{{ $unitKerja->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="p-3 bg-gray-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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
                            <a wire:navigate href="{{ route('unit-kerja.edit', $unitKerja->id) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Unit Kerja
                            </a>
                            
                            <a wire:navigate href="{{ route('unit-kerja.index') }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Lihat Semua Unit Kerja
                            </a>

                            {{-- View Employees Button (if there are employees) --}}
                            @if($unitKerja->pegawais_count > 0)
                            <button class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                Lihat Pegawai ({{ $unitKerja->pegawais_count }})
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>