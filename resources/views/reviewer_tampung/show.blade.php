<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Assignment Proposal') }}
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
                <!-- Menampilkan Proposal ID dari data proposal yang diassign -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Proposal ID') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $assignment->proposal->id }}
                    </div>
                </div>
                <!-- Menampilkan Proposal ID dari data proposal yang diassign -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Proposal ID') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $assignment->proposal->judul_penelitian }}
                    </div>
                </div>

                <!-- Tombol untuk melihat file proposal -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('File Proposal') }}</label>
                    <div class="mt-1">
                        <a href="{{ asset('storage/' . $assignment->proposal->file_proposal) }}" target="_blank">
                            <x-primary-button>
                                {{ __('Lihat Dokumen') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <!-- Menampilkan status assignment -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Status Assignment') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ ucfirst($assignment->assignment_status) }}
                    </div>
                </div>

                <!-- Tampilkan komentar reviewer -->
                @if($assignment->proposal->komentar_review)
                    <div class="mt-4">
                        <h3 class="block font-medium text-sm text-gray-700 dark:text-gray-400">Komentar Reviewer:</h3>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $assignment->proposal->komentar_review }}</p>
                    </div>
                @endif

                <!-- Tombol aksi: Kembali dan Upload Hasil Review -->
                <div class="flex items-center justify-end mt-4 space-x-4">
                    <x-secondary-button>
                        <a href="{{ route('reviewer_tampung.index') }}">
                            {{ __('Kembali') }}
                        </a>
                    </x-secondary-button>
                    @if (ucfirst($assignment->assignment_status) !== 'Completed')
                        <x-primary-button>
                            <a href="{{ route('reviewer_return.form', $assignment->id) }}">
                                {{ __('Upload Hasil Review') }}
                            </a>
                        </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
