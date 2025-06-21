<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Data Absensi</h1>
                    <p class="mt-2 text-gray-600">Kelola data kehadiran pegawai</p>
                </div>
                {{-- Quick Daily Attendance Button --}}
                <div class="flex items-center space-x-3">
                    <button wire:click="openDailyModal"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Absensi Harian
                    </button>
                    <a wire:navigate href="{{ route('absensi.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Individual
                    </a>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <span>{{ session('message') }}</span>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Tab Navigation --}}
        <div class="bg-white rounded-lg shadow-sm border mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                    <button wire:click="switchTab('list')"
                        class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-150
                               {{ $activeTab === 'list'
                                   ? 'border-blue-500 text-blue-600'
                                   : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            Daftar Absensi
                        </div>
                    </button>
                    <button wire:click="switchTab('daily')"
                        class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-150
                               {{ $activeTab === 'daily'
                                   ? 'border-blue-500 text-blue-600'
                                   : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Absensi Harian
                            @if ($dailyStats['not_set'] > 0)
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $dailyStats['not_set'] }} belum diabsen
                                </span>
                            @endif
                        </div>
                    </button>
                </nav>
            </div>
        </div>

        {{-- Content based on active tab --}}
        @if ($activeTab === 'list')
            {{-- List View (existing functionality) --}}
            @include('livewire.absensi.partials.list-view')
        @else
            {{-- Daily View --}}
            @include('livewire.absensi.partials.daily-view')
        @endif

        {{-- Daily Attendance Modal --}}
        @if ($showDailyModal)
            @include('livewire.absensi.partials.daily-modal')
        @endif

        {{-- Delete Confirmation Modal --}}
        @if ($showDeleteModal)
            @include('livewire.absensi.partials.delete-modal')
        @endif
    </div>
</div>
