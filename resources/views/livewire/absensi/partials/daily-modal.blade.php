{{-- filepath: c:\laragon\www\hr-sync\resources\views\livewire\absensi\partials\daily-modal.blade.php --}}
<div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Absensi Harian - {{ $formattedDate }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Tandai kehadiran semua pegawai untuk tanggal terpilih
                                </p>
                            </div>
                            <button wire:click="$set('showDailyModal', false)"
                                class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- Date Selector --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal</label>
                            <input type="date" wire:model.live="selectedDate"
                                class="block w-full sm:max-w-xs rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm">
                        </div>

                        {{-- Quick Actions --}}
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2">
                                <button wire:click="markAllAs('hadir')"
                                    class="inline-flex items-center px-3 py-1.5 border border-green-300 rounded-md text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-150">
                                    Semua Hadir
                                </button>
                                <button wire:click="markAllAs('alpha')"
                                    class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors duration-150">
                                    Semua Alpha
                                </button>
                                <button wire:click="markAllAs('sakit')"
                                    class="inline-flex items-center px-3 py-1.5 border border-yellow-300 rounded-md text-xs font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition-colors duration-150">
                                    Semua Sakit
                                </button>
                                <button wire:click="markAllAs('izin')"
                                    class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-150">
                                    Semua Izin
                                </button>
                                <button wire:click="clearAll"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                                    Bersihkan
                                </button>
                            </div>
                        </div>

                        {{-- Stats --}}
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            <div class="text-center">
                                <div class="text-lg font-semibold text-green-600">{{ $dailyStats['hadir'] }}</div>
                                <div class="text-xs text-gray-500">Hadir</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-semibold text-red-600">{{ $dailyStats['alpha'] }}</div>
                                <div class="text-xs text-gray-500">Alpha</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-semibold text-yellow-600">{{ $dailyStats['sakit'] }}</div>
                                <div class="text-xs text-gray-500">Sakit</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-semibold text-blue-600">{{ $dailyStats['izin'] }}</div>
                                <div class="text-xs text-gray-500">Izin</div>
                            </div>
                        </div>

                        {{-- Compact Table --}}
                        <div class="max-h-96 overflow-y-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 sticky top-0">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Pegawai</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($dailyAbsensis as $pegawaiId => $data)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                            <span class="text-xs font-medium text-gray-700">
                                                                {{ strtoupper(substr($data['pegawai']->nama, 0, 2)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $data['pegawai']->nama }}</div>
                                                        <div class="text-xs text-gray-500">{{ $data['pegawai']->nip }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex justify-center space-x-1">
                                                    {{-- Compact Radio Buttons --}}
                                                    @foreach (['hadir' => 'green', 'alpha' => 'red', 'sakit' => 'yellow', 'izin' => 'blue'] as $status => $color)
                                                        <label class="relative inline-flex items-center cursor-pointer"
                                                            title="{{ ucfirst($status) }}">
                                                            <input type="radio"
                                                                wire:model.live="dailyAbsensis.{{ $pegawaiId }}.status"
                                                                value="{{ $status }}" class="sr-only">
                                                            <div
                                                                class="w-6 h-6 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                                                                       {{ $data['status'] === $status
                                                                           ? "border-{$color}-500 bg-{$color}-500"
                                                                           : 'border-gray-300 hover:border-' . $color . '-400' }}">
                                                                @if ($data['status'] === $status)
                                                                    <svg class="w-3 h-3 text-white" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                                <div class="mt-1 text-xs text-center">
                                                    @if ($data['status'])
                                                        <span class="font-medium">{{ ucfirst($data['status']) }}</span>
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click="saveDailyAbsensi" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
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
                <button wire:click="$set('showDailyModal', false)" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
