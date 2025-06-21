<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                    <p class="mt-2 text-gray-600">Selamat datang di HR Sync - Sistem Manajemen SDM</p>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                    <div class="flex items-center space-x-2">
                        <select wire:model.live="selectedMonth"
                            class="text-sm border-gray-300 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @php
                                $months = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                            @endphp
                            @foreach ($months as $num => $name)
                                <option value="{{ $num }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        <select wire:model.live="selectedYear"
                            class="text-sm border-gray-300 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @for ($i = now()->year - 2; $i <= now()->year + 1; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats Cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            {{-- Total Pegawai --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500">Total Pegawai</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ number_format($totalPegawai) }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a wire:navigate href="{{ route('pegawai.index') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-500">
                            Lihat semua →
                        </a>
                    </div>
                </div>
            </div>

            {{-- Absensi Hari Ini --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500">Hadir Hari Ini</dt>
                                <dd class="text-2xl font-bold text-gray-900">
                                    {{ $absensiHariIni['hadir'] }}/{{ $totalAbsensiHariIni }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a wire:navigate href="{{ route('absensi.index') }}"
                            class="text-sm font-medium text-green-600 hover:text-green-500">
                            Lihat detail →
                        </a>
                    </div>
                </div>
            </div>

            {{-- Cuti Aktif --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500">Sedang Cuti</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $cutiAktif }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a wire:navigate href="{{ route('cuti.index') }}"
                            class="text-sm font-medium text-yellow-600 hover:text-yellow-500">
                            Lihat detail →
                        </a>
                    </div>
                </div>
            </div>

            {{-- Total Unit --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500">Unit Kerja</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $totalUnitKerja }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a wire:navigate href="{{ route('unit-kerja.index') }}"
                            class="text-sm font-medium text-purple-600 hover:text-purple-500">
                            Lihat semua →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Rekap Absensi Bulan Ini --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Rekapitulasi Absensi {{ $monthName }} {{ $selectedYear }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-green-600">{{ $absensiBulanIni['hadir'] }}
                                </div>
                                <div class="text-sm text-gray-500">Hadir</div>
                            </div>
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-red-600">{{ $absensiBulanIni['alpha'] }}</div>
                                <div class="text-sm text-gray-500">Alpha</div>
                            </div>
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-yellow-600">{{ $absensiBulanIni['sakit'] }}
                                </div>
                                <div class="text-sm text-gray-500">Sakit</div>
                            </div>
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-blue-600">{{ $absensiBulanIni['izin'] }}</div>
                                <div class="text-sm text-gray-500">Izin</div>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="text-center">
                                <div class="text-sm text-gray-500">Total Absensi</div>
                                <div class="text-3xl font-bold text-gray-900">{{ $totalAbsensiBulanIni }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chart Absensi 7 Hari Terakhir --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Tren Absensi 7 Hari Terakhir</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($chartData as $data)
                                <div class="flex items-center">
                                    <div class="w-16 text-sm text-gray-500">{{ $data['date'] }}</div>
                                    <div class="flex-1 ml-4">
                                        <div class="flex items-center space-x-2">
                                            {{-- Hadir --}}
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-green-500 rounded-full mr-1"></div>
                                                <span class="text-sm text-gray-600">{{ $data['hadir'] }}</span>
                                            </div>
                                            {{-- Alpha --}}
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-red-500 rounded-full mr-1"></div>
                                                <span class="text-sm text-gray-600">{{ $data['alpha'] }}</span>
                                            </div>
                                            {{-- Sakit --}}
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-1"></div>
                                                <span class="text-sm text-gray-600">{{ $data['sakit'] }}</span>
                                            </div>
                                            {{-- Izin --}}
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-1"></div>
                                                <span class="text-sm text-gray-600">{{ $data['izin'] }}</span>
                                            </div>
                                        </div>
                                        {{-- Progress Bar --}}
                                        <div class="flex mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            @php
                                                $total =
                                                    $data['hadir'] + $data['alpha'] + $data['sakit'] + $data['izin'];
                                            @endphp
                                            @if ($total > 0)
                                                <div class="bg-green-500"
                                                    style="width: {{ ($data['hadir'] / $total) * 100 }}%"></div>
                                                <div class="bg-red-500"
                                                    style="width: {{ ($data['alpha'] / $total) * 100 }}%"></div>
                                                <div class="bg-yellow-500"
                                                    style="width: {{ ($data['sakit'] / $total) * 100 }}%"></div>
                                                <div class="bg-blue-500"
                                                    style="width: {{ ($data['izin'] / $total) * 100 }}%"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-12 text-right text-sm text-gray-500">
                                        {{ $data['hadir'] + $data['alpha'] + $data['sakit'] + $data['izin'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Top Pegawai Absensi --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Pegawai Teraktif Bulan Ini</h2>
                    </div>
                    <div class="p-6">
                        @if ($topPegawaiAbsensi->count() > 0)
                            <div class="space-y-4">
                                @foreach ($topPegawaiAbsensi as $index => $pegawai)
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-600">{{ $index + 1 }}</span>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $pegawai->nama }}</p>
                                                    <p class="text-xs text-gray-500">{{ $pegawai->nip }}</p>
                                                </div>
                                                <div class="text-sm font-medium text-blue-600">
                                                    {{ $pegawai->absensis_count }} hari
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="size-12 mx-auto text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Belum ada data absensi bulan ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-8">
                {{-- Quick Actions --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a wire:navigate href="{{ route('absensi.create') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Absensi
                            </a>
                            <a wire:navigate href="{{ route('cuti.create') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Ajukan Cuti
                            </a>
                            <a wire:navigate href="{{ route('pegawai.create') }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                                Tambah Pegawai
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Recent Activities --}}
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            {{-- Recent Absensi --}}
                            @foreach ($recentAbsensi->take(3) as $absensi)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @switch($absensi->status)
                                            @case('hadir')
                                                <div
                                                    class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-green-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            @break

                                            @case('alpha')
                                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                            @break

                                            @case('sakit')
                                                <div
                                                    class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @break

                                            @case('izin')
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @break
                                        @endswitch
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">
                                            <span class="font-medium">{{ $absensi->pegawai->nama }}</span>
                                            {{ $absensi->status === 'hadir' ? 'hadir' : 'tidak hadir (' . $absensi->status . ')' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $absensi->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Recent Cuti --}}
                            @foreach ($recentCuti->take(2) as $cuti)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">
                                            <span class="font-medium">{{ $cuti->pegawai->nama }}</span>
                                            mengajukan cuti {{ $cuti->jumlah_hari }} hari
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $cuti->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
