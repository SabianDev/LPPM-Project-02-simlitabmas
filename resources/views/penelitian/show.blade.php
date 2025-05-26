<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penelitian') }}
        </h2>
        @if(session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
        @if(session('error'))
            <x-alert>
                {{ session('error') }}
            </x-alert>
        @endif
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Informasi utama penelitian -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Judul Penelitian') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $penelitian->title }}
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Status') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ ucfirst($penelitian->status) }}
                    </div>
                </div>
                
                <!-- Informasi tambahan, misalnya tanggal dibuat -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Tanggal Dibuat') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $penelitian->created_at->format('d/m/Y') }}
                    </div>
                </div>

                <!-- Tombol aksi: Kembali dan Lihat Progress -->
                <div class="flex items-center justify-end mt-4 space-x-4">
                    <x-secondary-button>
                        <a href="{{ route('penelitian.index') }}">
                            {{ __('Kembali') }}
                        </a>
                    </x-secondary-button>
                    <x-primary-button>
                        <a href="{{ route('progress.index', $penelitian->id) }}">
                            {{ __('Lihat Progress...') }}
                        </a>
                    </x-primary-button>
                    @if($penelitian->status === 'selesai')
                        <!-- Jika status sudah "selesai", tampilkan tombol Finalisasi Laporan -->
                        <x-secondary-button class="text-gray-700 dark:text-gray-400 cursor-not-allowed" disabled>
                                {{ __('Finalisasi Laporan') }}
                        </x-secondary-button>
                    @else
                        <!-- Jika belum selesai, tombol Finalisasi Laporan dinonaktifkan atau disembunyikan -->
                        <x-primary-button>
                            <a href="{{ route('final_report.create', $penelitian->id) }}">
                                {{ __('Finalisasi Laporan') }}
                            </a>
                        </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
