<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a wire:navigate href="{{ route('absensi.index') }}"
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
                                {{ strtoupper(substr($absensi->pegawai->nama, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-3xl font-bold text-gray-900">Detail Absensi</h1>
                        <p class="mt-1 text-gray-600">{{ $absensi->pegawai->nama }} ({{ $absensi->pegawai->nip }})</p>
                        <div class="mt-2 flex items-center space-x-2">
                            @switch($absensi->status)
                                @case('hadir')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Hadir
                                    </span>
                                @break

                                @case('alpha')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Alpha
                                    </span>
                                @break

                                @case('sakit')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                            </path>
                                        </svg>
                                        Sakit
                                    </span>
                                @break

                                @case('izin')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Izin
                                    </span>
                                @break
                            @endswitch
                            <span
                                class="text-sm text-gray-500">{{ $absensi->tanggal->locale('id')->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a wire:navigate href="{{ route('absensi.edit', $absensi->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Absensi
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Information --}}
            <div class="lg:col-span-2">
                {{-- Detail Absensi --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Absensi</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 mb-1">Pegawai</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $absensi->pegawai->nama }}</span>
                                        <span class="text-xs text-gray-500 mt-1">NIP:
                                            {{ $absensi->pegawai->nip }}</span>
                                        @if ($absensi->pegawai->jabatan)
                                            <span
                                                class="text-xs text-gray-500">{{ $absensi->pegawai->jabatan->nama_jabatan }}</span>
                                        @endif
                                        @if ($absensi->pegawai->unitKerja)
                                            <span
                                                class="text-xs text-gray-500">{{ $absensi->pegawai->unitKerja->nama_unit }}</span>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Tanggal</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $absensi->tanggal->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $absensi->tanggal->format('l') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Status Kehadiran</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    @switch($absensi->status)
                                        @case('hadir')
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-green-800">Hadir</p>
                                                    <p class="text-xs text-green-600">Pegawai hadir dan bekerja sesuai jadwal
                                                    </p>
                                                </div>
                                            </div>
                                        @break

                                        @case('alpha')
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-red-800">Alpha</p>
                                                    <p class="text-xs text-red-600">Tidak hadir tanpa keterangan</p>
                                                </div>
                                            </div>
                                        @break

                                        @case('sakit')
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-yellow-800">Sakit</p>
                                                    <p class="text-xs text-yellow-600">Tidak hadir karena sakit</p>
                                                </div>
                                            </div>
                                        @break

                                        @case('izin')
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-blue-800">Izin</p>
                                                    <p class="text-xs text-blue-600">Tidak hadir dengan izin</p>
                                                </div>
                                            </div>
                                        @break
                                    @endswitch
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
                                <dt class="text-sm font-medium text-gray-500 mb-1">ID Absensi</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    #{{ $absensi->id }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Dicatat Pada</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $absensi->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $absensi->created_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    <div class="flex flex-col">
                                        <span>{{ $absensi->updated_at->locale('id')->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ $absensi->updated_at->format('H:i:s') }}</span>
                                    </div>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Selisih Waktu</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $absensi->created_at->diffForHumans() }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Sidebar Stats --}}
            <div class="lg:col-span-1">
                {{-- Statistik Bulan Ini --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Statistik {{ now()->format('F Y') }}</h2>
                        <p class="text-sm text-gray-600">Rekap kehadiran {{ $absensi->pegawai->nama }}</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            {{-- Total --}}
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Total Absensi</p>
                                    <p class="text-2xl font-bold text-gray-600">{{ $totalBulanIni }}</p>
                                </div>
                                <div class="p-3 bg-gray-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Hadir --}}
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-green-900">Hadir</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $statistikBulanIni['hadir'] }}</p>
                                </div>
                                <div class="p-3 bg-green-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Alpha --}}
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-red-900">Alpha</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $statistikBulanIni['alpha'] }}</p>
                                </div>
                                <div class="p-3 bg-red-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Sakit --}}
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-yellow-900">Sakit</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $statistikBulanIni['sakit'] }}
                                    </p>
                                </div>
                                <div class="p-3 bg-yellow-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Izin --}}
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Izin</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $statistikBulanIni['izin'] }}</p>
                                </div>
                                <div class="p-3 bg-blue-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <a wire:navigate href="{{ route('absensi.edit', $absensi->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Absensi
                            </a>

                            <a wire:navigate href="{{ route('absensi.index') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Lihat Semua Absensi
                            </a>

                            <a wire:navigate href="{{ route('pegawai.show', $absensi->pegawai->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Detail Pegawai
                            </a>

                            <a wire:navigate href="{{ route('absensi.create') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Absensi Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
