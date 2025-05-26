<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Progress Penelitian') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Tampilkan Tanggal Upload -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Tanggal Upload') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $progress->created_at->format('d/m/Y') }}
                    </div>
                </div>

                <!-- Tampilkan Deskripsi Progress -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Deskripsi Progress') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $progress->description }}
                    </div>
                </div>

                <!-- Tampilkan Nama File Progress -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('File Progress') }}
                    </label>
                    <div class="mt-1">
                        <x-primary-button class="shadow">
                            <a href="{{ asset('storage/' . $progress->file_progress) }}" target="_blank">
                                {{ __('Lihat Dokumen') }}
                            </a>
                        </x-primary-button>
                    </div>
                </div>

                <!-- Tombol aksi -->
                <div class="flex items-center justify-end mt-4 space-x-4">

                    <a href="{{ route('progress.index', $progress->penelitian_id) }}">
                        <x-secondary-button>    
                            {{ __('Kembali') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button>
                        <a href="{{ route('progress.edit', $progress->id) }}">
                            {{ __('Edit') }}
                        </a>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
