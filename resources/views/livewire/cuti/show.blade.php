<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a wire:navigate href="{{ route('cuti.index') }}"
                    class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
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
                                {{ strtoupper(substr($cuti->pegawai->nama, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-3xl font-bold text-gray-900">Detail Cuti</h1>
                        <p class="mt-1 text-gray-600">{{ $cuti->pegawai->nama }} ({{ $cuti->pegawai->nip }})</p>
                        <div class="mt-2 flex items-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $cuti->jumlah_hari }} hari cuti
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a wire:navigate href="{{ route('cuti.edit', $cuti->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Cuti
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Information --}}
            <div class="lg:col-span-2">
                {{-- Detail Cuti --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Cuti</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Pegawai</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $cuti->pegawai->nama }}</span>
                                        <span class="text-xs text-gray-500 mt-1">NIP: {{ $cuti->pegawai->nip }}</span>
                                        @if ($cuti->pegawai->jabatan)
                                            <span
                                                class="text-xs text-gray-500">{{ $cuti->pegawai->jabatan->nama_jabatan }}</span>
                                        @endif
                                        @if ($cuti->pegawai->unitKerja)
                                            <span
                                                class="text-xs text-gray-500">{{ $cuti->pegawai->unitKerja->nama_unit }}</span>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Tanggal Mulai</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $cuti->tanggal_mulai->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $cuti->tanggal_mulai->locale('id')->translatedFormat('l') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Tanggal Akhir</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $cuti->tanggal_akhir->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $cuti->tanggal_akhir->locale('id')->translatedFormat('l') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Durasi Cuti</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <span class="text-lg font-semibold text-blue-600">{{ $cuti->jumlah_hari }}
                                        hari</span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Status</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    @if ($cuti->tanggal_mulai->isPast())
                                        @if ($cuti->tanggal_akhir->isPast())
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Selesai
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Sedang Cuti
                                            </span>
                                        @endif
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Akan Datang
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Alasan Cuti</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $cuti->alasan }}
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
                                        <span>{{ $cuti->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $cuti->created_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $cuti->updated_at->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $cuti->updated_at->format('H:i:s') }}</span>
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
                        <h2 class="text-lg font-semibold text-gray-900">Statistik Cuti {{ $cuti->tanggal_mulai->year }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            {{-- Total Jatah --}}
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Total Jatah</p>
                                    <p class="text-2xl font-bold text-blue-600">12 hari</p>
                                </div>
                                <div class="p-3 bg-blue-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Sudah Digunakan --}}
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-yellow-900">Sudah Digunakan</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $totalCutiTahunIni }} hari</p>
                                </div>
                                <div class="p-3 bg-yellow-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Sisa Cuti --}}
                            <div
                                class="flex items-center justify-between p-4 {{ $sisaCuti > 0 ? 'bg-green-50' : 'bg-red-50' }} rounded-lg">
                                <div>
                                    <p
                                        class="text-sm font-medium {{ $sisaCuti > 0 ? 'text-green-900' : 'text-red-900' }}">
                                        Sisa Cuti</p>
                                    <p
                                        class="text-2xl font-bold {{ $sisaCuti > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $sisaCuti }} hari</p>
                                </div>
                                <div class="p-3 {{ $sisaCuti > 0 ? 'bg-green-600' : 'bg-red-600' }} rounded-full">
                                    @if ($sisaCuti > 0)
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            {{-- Cuti Ini --}}
                            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-purple-900">Cuti Ini</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $cuti->jumlah_hari }} hari</p>
                                </div>
                                <div class="p-3 bg-purple-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <a wire:navigate href="{{ route('cuti.edit', $cuti->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Cuti
                            </a>

                            <a wire:navigate href="{{ route('cuti.index') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Lihat Semua Cuti
                            </a>

                            <a wire:navigate href="{{ route('pegawai.show', $cuti->pegawai->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Detail Pegawai
                            </a>

                            <a wire:navigate href="{{ route('cuti.create') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Ajukan Cuti Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
