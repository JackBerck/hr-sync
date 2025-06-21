{{-- Date Selector & Stats --}}
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
    {{-- Date Selector --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Tanggal</h3>
            <input type="date" wire:model.live="selectedDate"
                class="w-full rounded-lg px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <p class="mt-2 text-sm text-gray-600">{{ $formattedDate }}</p>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="lg:col-span-3">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            <div class="bg-white rounded-lg shadow-sm border p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Hadir</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $dailyStats['hadir'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Alpha</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $dailyStats['alpha'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Sakit</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $dailyStats['sakit'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Izin</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $dailyStats['izin'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
    <div class="flex flex-wrap gap-3">
        <button wire:click="markAllAs('hadir')"
            class="inline-flex items-center px-3 py-2 border border-green-300 rounded-lg text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            Tandai Semua Hadir
        </button>
        <button wire:click="markAllAs('alpha')"
            class="inline-flex items-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Tandai Semua Alpha
        </button>
        <button wire:click="clearAll"
            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
            Bersihkan Semua
        </button>
    </div>
</div>

{{-- Daily Attendance Table --}}
<div class="bg-white rounded-lg shadow-sm border overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Daftar Pegawai</h2>
                <p class="text-sm text-gray-600">Total: {{ count($dailyAbsensis) }} pegawai | Sudah diabsen:
                    {{ $dailyStats['total'] }}</p>
            </div>
            <button wire:click="saveDailyAbsensi"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg wire:loading wire:target="saveDailyAbsensi" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span wire:loading.remove wire:target="saveDailyAbsensi">Simpan Absensi</span>
                <span wire:loading wire:target="saveDailyAbsensi">Menyimpan...</span>
            </button>
        </div>
    </div>

    @if (count($dailyAbsensis) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pegawai
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jabatan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Unit Kerja
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Kehadiran
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($dailyAbsensis as $pegawaiId => $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ strtoupper(substr($data['pegawai']->nama, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $data['pegawai']->nama }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $data['pegawai']->nip }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $data['pegawai']->jabatan->nama_jabatan ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $data['pegawai']->unitKerja->nama_unit ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- Hadir --}}
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                            wire:model.live="dailyAbsensis.{{ $pegawaiId }}.status" value="hadir"
                                            class="sr-only">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                                                   {{ $data['status'] === 'hadir'
                                                       ? 'border-green-500 bg-green-500 scale-110'
                                                       : 'border-gray-300 hover:border-green-400' }}">
                                            <svg class="w-5 h-5 {{ $data['status'] === 'hadir' ? 'text-white' : 'text-gray-400' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </label>

                                    {{-- Alpha --}}
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                            wire:model.live="dailyAbsensis.{{ $pegawaiId }}.status" value="alpha"
                                            class="sr-only">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                                                   {{ $data['status'] === 'alpha' ? 'border-red-500 bg-red-500 scale-110' : 'border-gray-300 hover:border-red-400' }}">
                                            <svg class="w-5 h-5 {{ $data['status'] === 'alpha' ? 'text-white' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                    </label>

                                    {{-- Sakit --}}
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                            wire:model.live="dailyAbsensis.{{ $pegawaiId }}.status" value="sakit"
                                            class="sr-only">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                                                   {{ $data['status'] === 'sakit'
                                                       ? 'border-yellow-500 bg-yellow-500 scale-110'
                                                       : 'border-gray-300 hover:border-yellow-400' }}">
                                            <svg class="w-5 h-5 {{ $data['status'] === 'sakit' ? 'text-white' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                                </path>
                                            </svg>
                                        </div>
                                    </label>

                                    {{-- Izin --}}
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                            wire:model.live="dailyAbsensis.{{ $pegawaiId }}.status" value="izin"
                                            class="sr-only">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                                                   {{ $data['status'] === 'izin'
                                                       ? 'border-blue-500 bg-blue-500 scale-110'
                                                       : 'border-gray-300 hover:border-blue-400' }}">
                                            <svg class="w-5 h-5 {{ $data['status'] === 'izin' ? 'text-white' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                                <div class="mt-2 text-xs">
                                    @switch($data['status'])
                                        @case('hadir')
                                            <span class="text-green-600 font-medium">Hadir</span>
                                        @break

                                        @case('alpha')
                                            <span class="text-red-600 font-medium">Alpha</span>
                                        @break

                                        @case('sakit')
                                            <span class="text-yellow-600 font-medium">Sakit</span>
                                        @break

                                        @case('izin')
                                            <span class="text-blue-600 font-medium">Izin</span>
                                        @break

                                        @default
                                            <span class="text-gray-400">Belum diabsen</span>
                                    @endswitch
                                    @if ($data['is_existing'])
                                        <span class="ml-1 text-xs text-purple-600">(sudah ada)</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pegawai</h3>
            <p class="mt-1 text-sm text-gray-500">Tambahkan pegawai terlebih dahulu untuk dapat mencatat absensi.</p>
        </div>
    @endif
</div>

{{-- Legend --}}
<div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
    <h3 class="text-sm font-medium text-blue-800 mb-3">Keterangan:</h3>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="flex items-center">
            <div class="w-6 h-6 bg-green-500 rounded-full mr-2 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-sm text-blue-700">Hadir</span>
        </div>
        <div class="flex items-center">
            <div class="w-6 h-6 bg-red-500 rounded-full mr-2 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <span class="text-sm text-blue-700">Alpha (Tanpa Keterangan)</span>
        </div>
        <div class="flex items-center">
            <div class="w-6 h-6 bg-yellow-500 rounded-full mr-2 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                    </path>
                </svg>
            </div>
            <span class="text-sm text-blue-700">Sakit</span>
        </div>
        <div class="flex items-center">
            <div class="w-6 h-6 bg-blue-500 rounded-full mr-2 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-sm text-blue-700">Izin</span>
        </div>
    </div>
</div>
