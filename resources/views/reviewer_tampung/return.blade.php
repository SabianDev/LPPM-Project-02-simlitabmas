<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight>">
            {{ __('Upload Hasil Review') }}
        </h2>
    </x-slot>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if(session('error'))
                    <x-alert>
                        {{ session('error') }}
                    </x-alert>
                @endif

                <form method="POST" action="{{ route('reviewer_return.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Sembunyikan assignment_id -->
                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

                    <!-- Tampilkan Nama Proyek (Judul Proposal) dari file_proposal -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Judul Proposal') }}
                        </label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">
                            {{ $assignment->proposal->judul_penelitian }}
                        </div>
                    </div>

                    <!-- Upload File Hasil Review -->
                    <div class="mb-4">
                        <label for="review_file" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Upload File Hasil Review') }}
                        </label>
                        <input id="review_file" type="file" name="review_file" required class="mt-1 block w-full">
                    </div>

                    <!-- Pilih Status Review -->
                    <div class="mb-4">
                        <label for="review_status" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Status Review') }}
                        </label>
                        <select id="review_status" name="review_status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih --</option>
                            <option value="Approved">{{ __('Approved') }}</option>
                            <option value="Not Approved">{{ __('Not Approved') }}</option>
                        </select>
                    </div>

                    <!-- Beri komentar, opsional -->
                    <div class="mt-4">
                        <label for="komentar_review" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Komentar (opsional)</label>
                        <textarea name="komentar_review" id="komentar_review" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end mt-4 space-x-4">
                        <x-secondary-button>
                            <a href="{{ route('reviewer_tampung.show', $assignment->id) }}">
                                {{ __('Kembali') }}
                            </a>
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Kirim') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
